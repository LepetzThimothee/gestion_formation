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

        return view("plan.index", ['plans' => $plans]);
    }

    public function create(Request $request) {
        $salaries = Salarie::all();
        $cession = null;
        $duree = null;
        $intitule = null;
        $stage = Stage::whereSession($request->input('session'))->first();
        if($stage) {
            $cession = $stage->session;
            $duree = $stage->duree;
            $intitule = $stage->intitule;
        }
        return view("plan.create", ['salaries' => $salaries, 'cession' => $cession, 'intitule' => $intitule, 'duree' => $duree]);
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
                    'total' => $total,
                ]);
            }
        }

        return redirect("/plan")->with('status', "Plan créé avec succès");
    }

    public function fileImportExport()
    {
        return view('formation-import-export');
    }

    public function planImport(Request $request)
    {
        Stage::truncate(); Formation::truncate(); // On vide les tables
        $bergerie = new MultiSheetSelectorImport();
        $bergerie->onlySheets("Organismes de formation","Salariés","Stage");
        Excel::import($bergerie, $request->file('file'));
        return redirect('/file-import-export')->with('status', 'Tables importées avec succès!');
    }

    public function planExport()
    {
        return Excel::download(new MultiSheetSelectorExport, 'bergerie.xlsx');
    }
}
