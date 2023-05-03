<?php

namespace App\Http\Controllers;

use App\Exports\StageSheetExporter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StageRequest;
use App\Imports\MultiSheetSelectorImport;
use App\Models\Formation;
use App\Models\Stage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StageController extends Controller
{
    public function create() {
        $formations = Formation::all();
        $stagesSession = Stage::pluck('session');
        $stagesSession = $stagesSession->filter(function ($session) { // permets de filtrer les sessions pour avoir que des sessions valides
            return is_numeric($session);
        });
        $derniereSession = $stagesSession->max(); // récupération de la session la plus grande ce qui correspond donc au dernier stage référencé
        if (!$derniereSession) {
            $derniereSession = intval(now()->format('y') . "0001"); // si on n'a pas trouvé de session correcte alors on met la première session de l'année
        }
        return view('stages.create', ['formations' => $formations, 'session' => $derniereSession]);
    }

    public function store(StageRequest $request) {
        $finFormation = null;
        if ($request->input('fin_formation')) {
            $finFormation = Carbon::parse($request->input('fin_formation'))->format('d/m/Y'); // on verifie que la date de fin de formation existe pour pouvoir lui changer son format
        }
        $stage = Stage::create([
            'session' => $request->input('session'),
            'intitule' => $request->input('intitule'),
            'numero' => $request->input('numero'),
            'formation_id' => Formation::whereOrganisme($request->input('organisme'))->first()->id,
            'organisme' => $request->input('organisme'),
            'formation_obligatoire' => $request->input('formation_obligatoire'),
            'intra_inter' => $request->input('intra_inter'),
            'cout_pedagogique' => $request->input('cout_pedagogique'),
            'debut_formation' => Carbon::parse($request->input('debut_formation'))->format('d/m/Y'),
            'fin_formation' => $finFormation,
            'duree' => $request->input('duree'),
            'opco' => $request->input('opco'),
            'convention' => $request->input('convention'),
            'convocation' => $request->input('convocation'),
            'attestation' => $request->input('attestation'),
            'facture' => $request->input('facture'),
        ]);
        $stage->save();
        return redirect("/")->with('status', "Stage créé avec succès");
    }

    public function stageImport(Request $request)
    {
        Stage::truncate(); // On vide la base de données formation
        $stage = new MultiSheetSelectorImport();
        $stage->onlySheets('Stage'); // On prend que la feuille qui nous interesse
        Excel::import($stage, $request->file('file'));
        return redirect('/file-import-export')->with('status', 'Stages Importés avec succès!');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function stageExport(Request $request)
    {
        return Excel::download(new StageSheetExporter, 'stage.xlsx');
    }
}
