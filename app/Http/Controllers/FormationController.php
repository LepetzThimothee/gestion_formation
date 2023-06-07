<?php

namespace App\Http\Controllers;

use App\Exports\FormationSheetExporter;
use App\Http\Requests\FormationRequest;
use App\Imports\MultiSheetSelectorImport;
use App\Models\Formation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FormationController extends Controller
{
    /**
     * Affiche la liste des formations.
     *
     * @return View
     */
    public function index(): View
    {
        $formations = Formation::all();
        return view('formations.index', ['formations' => $formations]);
    }

    /**
     * Affiche les détails d'une formation.
     *
     * @param Formation $formation
     * @return View
     */
    public function show(Formation $formation): View
    {
        return view('formations.show', ['formation' => $formation]);
    }

    /**
     * Affiche le formulaire de création d'une formation.
     *
     * @return View
     */
    public function create(): View
    {
        return view('formations.create');
    }

    /**
     * Enregistre une nouvelle formation.
     *
     * @param FormationRequest $request
     * @return RedirectResponse
     */
    public function store(FormationRequest $request): RedirectResponse
    {
        $formation = Formation::create([
            'organisme' => $request->input('organisme'),
            'telephone' => $request->input('telephone'),
            'email' => $request->input('email'),
            'numero_declaration_existence' => $request->input('numero_declaration_existence'),
            'siret' => $request->input('siret'),
            'adresse' => $request->input('adresse'),
            'interlocuteur' => $request->input('interlocuteur')
        ]);
        $formation->save();
        return redirect(route("stages.create"))->with('status', "Formation créée avec succès");
    }

    /**
     * Affiche le formulaire d'édition d'une formation.
     *
     * @param Formation $formation
     * @return View
     */
    public function edit(Formation $formation): View
    {
        return view('formations.edit', ['formation' => $formation]);
    }

    /**
     * Met à jour une formation existante.
     *
     * @param FormationRequest $request
     * @param Formation $formation
     * @return RedirectResponse
     */
    public function update(FormationRequest $request, Formation $formation): RedirectResponse
    {
        $formation->organisme = $request->input('organisme');
        $formation->telephone = $request->input('telephone');
        $formation->email = $request->input('email');
        $formation->numero_declaration_existence = $request->input('numero_declaration_existence');
        $formation->siret = $request->input('siret');
        $formation->adresse = $request->input('adresse');
        $formation->interlocuteur = $request->input('interlocuteur');
        $formation->save();

        return redirect(route("formations.index"))->with('status', "Formation mise à jour avec succès");
    }

    /**
     * Supprime une formation.
     *
     * @param Formation $formation
     * @return RedirectResponse
     */
    public function destroy(Formation $formation): RedirectResponse
    {
        $stages = $formation->stages;
        // On vérifie si des stages référencent cette formation
        if ($stages->count() > 0) {
            $stageInfo = $stages->map(function($stage) {
                return "(Numéro de session : $stage->session, Intitulé : $stage->intitule)";
            })->implode(' | ');

            return redirect(route('formations.index'))->with('error', "La formation ne peut pas être supprimée car elle est associée aux stages suivants : $stageInfo");
        }
        // On supprime la formation
        $formation->delete();

        return redirect(route('formations.index'))->with('status', 'Formation supprimée avec succès.');
    }

    /**
     * Importe les formations à partir d'un fichier Excel.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function formationImport(Request $request): RedirectResponse
    {
        if ($request->hasFile('file')) {
            $formation = new MultiSheetSelectorImport();
            $formation->onlySheets('Organismes de formation');
            Excel::import($formation, $request->file('file'));
            return redirect('/file-import-export')->with('status', 'Formations importées avec succès!');
        } else {
            return redirect('/file-import-export')->with('error', 'Aucun fichier n\'a été sélectionné.');
        }
    }

    /**
     * Exporte les formations vers un fichier Excel.
     *
     * @return BinaryFileResponse
     */
    public function formationExport(): BinaryFileResponse
    {
        return Excel::download(new FormationSheetExporter, 'formation.xlsx');
    }
}
