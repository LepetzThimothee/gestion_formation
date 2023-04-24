<?php

namespace App\Http\Controllers;

use App\Exports\FormationSheetExporter;
use App\Http\Controllers\Controller;
use App\Imports\MultiSheetSelectorImport;
use App\Models\Formation;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class FormationController extends Controller
{
    public function fileImportExport()
    {
        return view('formation-import-export');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function formationImport(Request $request)
    {
        Schema::disableForeignKeyConstraints(); // On retire les contraintes de clé étrangère pour pouvoir vider les données de formation
        Formation::truncate(); // On vide la base de données formation
        $formation = new MultiSheetSelectorImport();
        $formation->onlySheets('Organismes de formation'); // On prend que la feuille qui nous interesse
        Excel::import($formation, $request->file('file'));
        Schema::enableForeignKeyConstraints(); // On n'oublie pas de remettre les contraintes de clé étrangère
        return redirect('/file-import-export')->with('success', 'Formations Import Successfully!');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function formationExport(Request $request)
    {
        return Excel::download(new FormationSheetExporter, 'formation.xlsx');
    }
}
