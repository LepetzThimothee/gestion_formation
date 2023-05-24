<?php

namespace App\Http\Controllers;

use App\Exports\SalarieSheetExporter;
use App\Http\Controllers\Controller;
use App\Imports\MultiSheetSelectorImport;
use App\Models\Salarie;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SalarieController extends Controller
{
    public function index() {
        $salaries = Salarie::all();
        return view('salaries.index', compact('salaries'));
    }

    public function salarieImport(Request $request)
    {
        $salarie = new MultiSheetSelectorImport();
        $salarie->onlySheets('Salariés'); // On prend que la feuille qui nous interesse
        Excel::import($salarie, $request->file('file'));
        return redirect('/file-import-export')->with('status', 'Salaries Importés avec succès!');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function salarieExport(Request $request)
    {
        return Excel::download(new SalarieSheetExporter, 'salarie.xlsx');
    }
}
