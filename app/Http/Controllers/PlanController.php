<?php

namespace App\Http\Controllers;

use App\Exports\MultiSheetSelectorExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Imports\MultiSheetSelectorImport;
use App\Models\Formation;
use App\Models\Plan;
use App\Models\Salarie;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class PlanController extends Controller
{
    public function index() {
        $plans = Plan::with('salaries')->with('stage')->orderByDesc('id')->get();
        $codeEtablissements = Salarie::pluck('code_etablissement')->unique();
        $annees = [];
        foreach ($plans as $plan) {
            $dateFinFormation = date_create_from_format('d/m/Y', $plan->stage->fin_formation);
            $anneeFinFormation = date_format($dateFinFormation, 'Y');
            if (!in_array($anneeFinFormation, $annees)) {
                $annees[] = $anneeFinFormation;
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

    public function show($id)
    {
        $plan = Plan::findOrFail($id);
        return view('plan.show', ['plan' => $plan]);
    }

    public function create(Request $request) {
        $stage = Stage::whereSession($request->input('session'))->first();
        $plan = Plan::whereStageId($stage->id)->first();
        if($plan) return $this->edit($plan->id, true);
        $salaries = Salarie::all();
        // permet d'avoir le nom, prénom et matricule du salarié
        $salariesNomComplet = $salaries->map(function($salarie) { return $salarie->nom . ' ' . $salarie->prenom . ' [' . $salarie->matricule . ']'; });
        return view("plan.create", ['salaries' => $salariesNomComplet, 'stage' => $stage]);
    }

    public function store(PlanRequest $request)
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
                $total = (Cache::get('charges_patronales')*$salarie->taux_horaire*$nombre_heures_realisees) + $cout_pedagogique_stagiaire+$transport+$hebergement+$restauration;
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

    public function edit($id, $deCreation = false)
    {
        $plan = Plan::findOrFail($id);
        $salaries = Salarie::all();
        $salariesNomComplet = $salaries->map(function($salarie) { return $salarie->nom . ' ' . $salarie->prenom . ' [' . $salarie->matricule . ']'; });
        return view('plan.edit', ['plan' => $plan, 'salaries' => $salariesNomComplet, 'fromCreation' => $deCreation]);
    }

    public function update(PlanRequest $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $stage = $plan->stage;
        $nombre_salaries = $request->input('nombre_stagiaires');
        $cout_pedagogique_stagiaire = $stage->cout_pedagogique / $nombre_salaries;

        $plan->nombre_stagiaires = $nombre_salaries;
        $plan->cout_pedagogique_stagiaire = $cout_pedagogique_stagiaire;
        $plan->save();

        $salaries = $request->input('matricule');
        $plan->salaries()->detach(); // Supprimer les relations existantes

        foreach ($salaries as $index => $salarie) {
            $matches = [];

            if (preg_match('/\[(.*?)\]/', $salarie, $matches)) {
                $matricule = $matches[1];
            } else {
                $matricule = null;
            }

            $salarieModel = Salarie::whereMatricule($matricule)->first();

            if ($salarieModel) {
                $nombre_heures_realisees = $request->input('nombre_heures_realisees')[$index];
                $transport = $request->input('transport')[$index];
                $hebergement = $request->input('hebergement')[$index];
                $restauration = $request->input('restauration')[$index];
                $total = (Cache::get('charges_patronales') * $salarieModel->taux_horaire * $nombre_heures_realisees) + $cout_pedagogique_stagiaire + $transport + $hebergement + $restauration;

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

    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();
    }

    public function detach($planId, $salarieId)
    {
        $plan = Plan::findOrFail($planId);
        $salarie = Salarie::findOrFail($salarieId);

        // Supprime le lien pivot entre le plan et le salarié sans supprimer le salarié lui-même
        $plan->salaries()->detach($salarie);
        if ($plan->salaries()->count() == 0) {
            $this->destroy($planId);
            return redirect(route('plan.index'))->with('status', 'Aucun salarié dans le plan, suppression du plan.');
        }
        $plan->nombre_stagiaires = $plan->salaries()->count();
        $plan->cout_pedagogique_stagiaire = $plan->stage->cout_pedagogique/$plan->nombre_stagiaires;
        $plan->save();
        return redirect(route('plan.show', $planId))->with('status', 'Salarié détaché du plan avec succès.');
    }

    public function planImport(Request $request)
    {
        $planImport = new MultiSheetSelectorImport();
        $planImport->onlySheets("Organismes de formation","Stage","Salariés","Plan");
        Excel::import($planImport, $request->file('file'));

        $plans = Plan::all();

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

                $total = ($charges_patronales * $salarie->taux_horaire * $nombre_heures_realisees) + $cout_pedagogique_stagiaire + $transport + $hebergement + $restauration;

                $salarie->pivot->total = floatval(number_format($total, 2, '.', ''));
                $salarie->pivot->save();
            }

            $plan->save();
        }

        return redirect('/file-import-export')->with('status', 'Plan importé avec succès!');
    }

    public function planExport()
    {
        return Excel::download(new MultiSheetSelectorExport, 'bergerie.xlsx');
    }
}
