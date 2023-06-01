<?php

namespace App\Http\Controllers;

use App\Exports\FormationSheetExporter;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormationRequest;
use App\Imports\MultiSheetSelectorImport;
use App\Models\Formation;
use App\Models\Salarie;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class FormationController extends Controller
{
    public function index() {
        $formations = Formation::all();
        return view('formations.index', ['formations' => $formations]);
    }

    public function create()
    {
        return view('formations.create');
    }

    public function store(FormationRequest $request) {
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function formationImport(Request $request)
    {
        $formation = new MultiSheetSelectorImport();
        $formation->onlySheets('Organismes de formation'); // On prend que la feuille qui nous interesse
        Excel::import($formation, $request->file('file'));
        return redirect('/file-import-export')->with('status', 'Formations Importés avec succès!');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function formationExport(Request $request)
    {
        return Excel::download(new FormationSheetExporter, 'formation.xlsx');
    }
}
