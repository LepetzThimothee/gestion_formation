<?php

namespace App\Http\Controllers;

use App\Exports\StageSheetExporter;
use App\Http\Requests\StageRequest;
use App\Imports\MultiSheetSelectorImport;
use App\Models\Formation;
use App\Models\Stage;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class StageController extends Controller
{
    /**
     * Affiche la liste des stages.
     *
     * @return View
     */
    public function index(): View
    {
        $stages = Stage::all();
        return view('stages.index', ['stages' => $stages]);
    }

    /**
     * Affiche les détails d'un stage.
     *
     * @param Stage $stage
     * @return View
     */
    public function show(Stage $stage): View
    {
        return view('stages.show', ['stage' => $stage]);
    }

    /**
     * Affiche le formulaire de création d'un stage.
     *
     * @return View
     */
    public function create(): View
    {
        $formations = Formation::all();
        $stagesSession = Stage::pluck('session');
        $derniereSession = $stagesSession->max(); // récupération de la session la plus grande ce qui correspond donc au dernier stage référencé
        if (!$derniereSession) {
            $derniereSession = intval(now()->format('y') . "0000"); // si on n'a pas trouvé de session correcte alors on met la première session de l'année
        }
        return view('stages.create', ['formations' => $formations, 'cession' => $derniereSession]);
    }

    /**
     * Enregistre un nouveau stage.
     *
     * @param StageRequest $request
     * @return RedirectResponse
     */
    public function store(StageRequest $request): RedirectResponse
    {
        $finFormation = null;
        if ($request->input('fin_formation')) {
            $finFormation = Carbon::parse($request->input('fin_formation'))->format('d/m/Y'); // on vérifie que la date de fin de formation existe pour pouvoir lui changer son format
        }
        $stage = Stage::create([
            'session' => $request->input('session'),
            'intitule' => $request->input('intitule'),
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
        return redirect("/stages")->with('status', "Stage créé avec succès");
    }

    /**
     * Affiche le formulaire d'édition d'un stage.
     *
     * @param Stage $stage
     * @return View
     */
    public function edit(Stage $stage): View
    {
        $formations = Formation::all();
        return view('stages.edit', ['stage' => $stage, 'formations' => $formations]);
    }

    /**
     * Met à jour un stage existant.
     *
     * @param StageRequest $request
     * @param Stage $stage
     * @return RedirectResponse
     */
    public function update(StageRequest $request, Stage $stage): RedirectResponse
    {
        $finFormation = null;
        if ($request->input('fin_formation')) {
            $finFormation = Carbon::parse($request->input('fin_formation'))->format('d/m/Y');
        }
        $stage->update([
            'session' => $request->input('session'),
            'intitule' => $request->input('intitule'),
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
        return redirect("/stages")->with('status', "Stage mis à jour avec succès");
    }

    /**
     * Supprime un stage.
     *
     * @param Stage $stage
     * @return RedirectResponse
     */
    public function destroy(Stage $stage): RedirectResponse
    {
        $plans = $stage->plans;
        // On vérifie si le stage est référencé dans le plan
        if ($plans) {
            return redirect(route('stages.index'))->with('error', "Le stage ne peut pas être supprimé car il est référencé dans le plan");
        }
        // On supprime le stage
        $stage->delete();
        return redirect(route('stages.index'))->with('status', "Stage supprimé avec succès");
    }

    /**
     * Importe les stages à partir d'un fichier Excel.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function stageImport(Request $request): RedirectResponse
    {
        if ($request->hasFile('file')) {
            $stage = new MultiSheetSelectorImport();
            $stage->onlySheets('Stage'); // On prend que la feuille qui nous interesse
            Excel::import($stage, $request->file('file'));
            return redirect('/file-import-export')->with('status', 'Stages Importés avec succès!');
        } else {
            return redirect('/file-import-export')->with('error', 'Aucun fichier n\'a été sélectionné.');
        }
    }

    /**
     * Exporte les stages vers un fichier Excel.
     *
     * @return BinaryFileResponse
     */
    public function stageExport(): BinaryFileResponse
    {
        return Excel::download(new StageSheetExporter, 'stage.xlsx');
    }
}
