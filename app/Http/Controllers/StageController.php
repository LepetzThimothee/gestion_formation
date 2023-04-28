<?php

namespace App\Http\Controllers;

use App\Exports\StageSheetExporter;
use App\Http\Controllers\Controller;
use App\Imports\MultiSheetSelectorImport;
use App\Models\Stage;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StageController extends Controller
{
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
