<?php

namespace App\Http\Controllers;

use App\Exports\MultiSheetSelectorExport;
use App\Http\Requests\PlanRequest;
use App\Imports\MultiSheetSelectorImport;
use App\Models\Plan;
use App\Models\Salarie;
use App\Models\Stage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Le contrôleur qui gère les fonctionnalités liées aux plans.
 */
class PlanController extends Controller
{
    /**
     * Affiche la liste des plans.
     *
     * @return View
     */
    public function index(): View {
        // Récupère tous les plans avec leurs relations (salaries, stage) triés par ordre décroissant d'ID
        $plans = Plan::with('salaries')->with('stage')->orderByDesc('id')->get();
        // Récupère les codes d'établissements des salariés
        $codeEtablissements = Salarie::pluck('code_etablissement')->unique();
        $annees = [];
        foreach ($plans as $plan) {
            $dateDebutFormation = date_create_from_format('d/m/Y', $plan->stage->debut_formation);
            if ($dateDebutFormation) {
                $anneeDebutFormation = date_format($dateDebutFormation, 'Y');
                if (!in_array($anneeDebutFormation, $annees)) {
                    $annees[] = $anneeDebutFormation;
                }
            }

            $dateFinFormation = date_create_from_format('d/m/Y', $plan->stage->fin_formation);
            if ($dateFinFormation) {
                $anneeFinFormation = date_format($dateFinFormation, 'Y');
                if (!in_array($anneeFinFormation, $annees)) {
                    $annees[] = $anneeFinFormation;
                }
            }
        }

        $totalTotaux = 0;
        foreach ($plans as $plan) {
            foreach ($plan->salaries as $salarie) {
                $totalTotaux += $salarie->pivot->total;
            }
        }
        return view("plan.index", ['plans' => $plans, 'annees' => $annees, 'codeEtablissements' => $codeEtablissements, 'totalTotaux' => number_format($totalTotaux, 2, '.', '')]);
    }

    /**
     * Affiche les détails d'un plan spécifique.
     *
     * @param Plan $plan
     * @return View
     */
    public function show(Plan $plan): View
    {
        return view('plan.show', ['plan' => $plan]);
    }

    /**
     * Affiche le formulaire de création d'un nouveau plan.
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {
        $stage = Stage::whereSession($request->input('session'))->first();
        $plan = Plan::whereStageId($stage->id)->first();
        if($plan) {
            // Si le plan existe, on redirige vers la méthode d'édition avec le plan existant
            return $this->edit($plan, true);
        }
        $salaries = Salarie::all();

        // Permet d'avoir une liste contenant le nom, prénom et matricule de chaque salarié.
        $salariesNomComplet = $salaries->map(function($salarie) {
            return $salarie->nom . ' ' . $salarie->prenom . ' [' . $salarie->matricule . ']';
        });

        return view("plan.create", ['salaries' => $salariesNomComplet, 'stage' => $stage]);
    }

    /**
     * Enregistre un nouveau plan dans la base de données.
     *
     * @param PlanRequest $request
     * @return RedirectResponse
     */
    public function store(PlanRequest $request): RedirectResponse
    {
        // On crée un nouveau plan avec l'intitulé de stage
        $stage = Stage::whereSession($request->input('session'))->first();
        $nombre_salaries = $request->input('nombre_stagiaires');
        $cout_pedagogique_stagiaire = $stage->cout_pedagogique/$nombre_salaries;
        $plan = Plan::create([
            'stage_id' => $stage->id,
            'nombre_stagiaires' => $nombre_salaries,
            'cout_pedagogique_stagiaire' => $cout_pedagogique_stagiaire
        ]);
        $plan->save();

        // On ajoute les salariés ainsi que les autres informations au plan
        $salaries = $request->input('matricule');
        foreach ($salaries as $index => $salarie) {
            $matches = [];

            // On utilise la fonction preg_match pour extraire le matricule du salarié entre crochets
            if (preg_match('/\[(.*?)\]/', $salarie, $matches)) {
                $matricule = $matches[1]; // Le matricule du salarié sera dans la variable $matches à l'index 1
            } else {
                $matricule = null;
            }
            $salarie = Salarie::whereMatricule($matricule)->first();
            if ($salarie) {
                $nombre_heures_realisees = $request->input('nombre_heures_realisees')[$index];
                $transport = $request->input('transport')[$index];
                $hebergement = $request->input('hebergement')[$index];
                $restauration = $request->input('restauration')[$index];
                // On calcule le total en utilisant les valeurs des charges patronales et du taux horaire du salarié
                $total = (Cache::get('charges_patronales') * $salarie->taux_horaire * $nombre_heures_realisees) + $cout_pedagogique_stagiaire + $transport + $hebergement + $restauration;
                // On attache le salarié au plan avec les informations mises à jour
                $plan->salaries()->attach($salarie->matricule,[
                    'nombre_heures_realisees' => $nombre_heures_realisees,
                    'transport' => $transport,
                    'hebergement' => $hebergement,
                    'restauration' => $restauration,
                    'total' => floatval(number_format($total, 2, '.', '')),
                ]);
            }
        }

        return redirect(route('plan.index'))->with('status', "Plan créé avec succès");
    }

    /**
     * Affiche le formulaire d'édition d'un plan existant.
     *
     * @param Plan $plan
     * @param bool $provientDeCreation
     * @return View
     */
    public function edit(Plan $plan, bool $provientDeCreation = false): View
    {
        $salaries = Salarie::all();
        // Permet d'avoir une liste contenant le nom, prénom et matricule de chaque salarié
        $salariesNomComplet = $salaries->map(function($salarie) {
            return $salarie->nom . ' ' . $salarie->prenom . ' [' . $salarie->matricule . ']';
        });
        return view('plan.edit', ['plan' => $plan, 'salaries' => $salariesNomComplet, 'fromCreation' => $provientDeCreation]);
    }

    /**
     * Met à jour un plan existant avec les nouvelles données fournies.
     *
     * @param PlanRequest $request
     * @param Plan $plan
     * @return RedirectResponse
     */
    public function update(PlanRequest $request, Plan $plan): RedirectResponse
    {
        $stage = $plan->stage;
        $nombre_salaries = $request->input('nombre_stagiaires');
        $cout_pedagogique_stagiaire = $stage->cout_pedagogique / $nombre_salaries;

        $plan->nombre_stagiaires = $nombre_salaries;
        $plan->cout_pedagogique_stagiaire = $cout_pedagogique_stagiaire;
        $plan->save();

        $salaries = $request->input('matricule');
        $plan->salaries()->detach(); // On supprime les relations existantes avec les salariés

        foreach ($salaries as $index => $salarie) {
            $matches = [];

            // On utilise la fonction preg_match pour extraire le matricule du salarié entre crochets
            if (preg_match('/\[(.*?)\]/', $salarie, $matches)) {
                $matricule = $matches[1]; // Le matricule du salarié sera dans la variable $matches à l'index 1
            } else {
                $matricule = null;
            }

            $salarieModel = Salarie::whereMatricule($matricule)->first();

            if ($salarieModel) {
                $nombre_heures_realisees = $request->input('nombre_heures_realisees')[$index];
                $transport = $request->input('transport')[$index];
                $hebergement = $request->input('hebergement')[$index];
                $restauration = $request->input('restauration')[$index];
                // On calcule le total en utilisant les valeurs des charges patronales et du taux horaire du salarié
                $total = (Cache::get('charges_patronales') * $salarieModel->taux_horaire * $nombre_heures_realisees) + $cout_pedagogique_stagiaire + $transport + $hebergement + $restauration;
                // On attache le salarié au plan avec les informations mises à jour
                $plan->salaries()->attach($salarieModel->matricule, [
                    'nombre_heures_realisees' => $nombre_heures_realisees,
                    'transport' => $transport,
                    'hebergement' => $hebergement,
                    'restauration' => $restauration,
                    'total' => floatval(number_format($total, 2, '.', '')),
                ]);
            }
        }

        return redirect("/plan")->with('status', "Plan mis à jour avec succès (session : " . $stage->session . ")");
    }

    /**
     * Supprime un plan de la base de données.
     *
     * @param Plan $plan
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
    }

    /**
     * Supprime la relation entre un plan et un salarié.
     *
     * @param $planId
     * @param $salarieId
     * @return RedirectResponse
     */
    public function detach($planId, $salarieId): RedirectResponse
    {
        $plan = Plan::findOrFail($planId);
        $salarie = Salarie::findOrFail($salarieId);

        // Supprime le lien pivot entre le plan et le salarié sans supprimer le salarié lui-même
        $plan->salaries()->detach($salarie);
        if ($plan->salaries()->count() == 0) {
            $this->destroy($plan);
            return redirect(route('plan.index'))->with('status', 'Aucun salarié dans le plan, suppression du plan.');
        }
        $plan->nombre_stagiaires = $plan->salaries()->count();
        $plan->cout_pedagogique_stagiaire = $plan->stage->cout_pedagogique/$plan->nombre_stagiaires;
        $plan->save();
        return redirect(route('plan.show', $planId))->with('status', 'Salarié détaché du plan avec succès.');
    }

    /**
     * Importe le plan à partir d'un fichier Excel.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function planImport(Request $request): RedirectResponse
    {
        if ($request->hasFile('file')) {
            $planImport = new MultiSheetSelectorImport();
            $planImport->onlySheets("Organismes de formation","Stage","Salariés","Plan");
            Excel::import($planImport, $request->file('file'));
            $plans = Plan::all();
            /** @var Plan $plan */
            foreach ($plans as $plan) {
                $salaries = $plan->salaries;
                $nombreStagiaires = $salaries->count();
                $cout_pedagogique_stagiaire = $plan->stage->cout_pedagogique/$nombreStagiaires;
                $plan->nombre_stagiaires = $nombreStagiaires;
                $plan->cout_pedagogique_stagiaire = $cout_pedagogique_stagiaire;

                foreach ($salaries as $salarie) {
                    $transport = $salarie->pivot->transport;
                    $hebergement = $salarie->pivot->hebergement;
                    $restauration = $salarie->pivot->restauration;
                    $nombre_heures_realisees = $salarie->pivot->nombre_heures_realisees;
                    $charges_patronales = Cache::get('charges_patronales');
                    // On calcule le total en utilisant les valeurs des charges patronales et du taux horaire du salarié
                    $total = ($charges_patronales * $salarie->taux_horaire * $nombre_heures_realisees) + $cout_pedagogique_stagiaire + $transport + $hebergement + $restauration;

                    $salarie->pivot->total = floatval(number_format($total, 2, '.', ''));
                    $salarie->pivot->save();
                }
                $plan->save();
            }
            return redirect('/file-import-export')->with('status', 'Plan importé avec succès!');
        } else {
            return redirect('/file-import-export')->with('error', 'Aucun fichier n\'a été sélectionné.');
        }
    }

    /**
     * Exporte les données des plans vers un fichier Excel.
     *
     * @return BinaryFileResponse
     */
    public function planExport(): BinaryFileResponse
    {
        return Excel::download(new MultiSheetSelectorExport, 'bergerie.xlsx');
    }
}
