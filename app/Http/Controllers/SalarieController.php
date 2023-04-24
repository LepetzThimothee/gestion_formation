<?php

namespace App\Http\Controllers;

use App\Exports\SalarieExport;
use App\Http\Controllers\Controller;
use App\Imports\MultiSheetSelector;
use App\Models\Salarie;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SalarieController extends Controller
{
    public function salarieImport(Request $request)
    {
        Salarie::truncate(); // On vide la base de données formation
        $salarie = new MultiSheetSelector();
        $salarie->onlySheets('Salariés'); // On prend que la feuille qui nous interesse
        Excel::import($salarie, $request->file('file'));
        return redirect('/file-import-export')->with('success', 'Salaries Import Successfully!');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function salarieExport(Request $request)
    {
        return Excel::download(new SalarieExport, 'salarie.xlsx');
    }
}
