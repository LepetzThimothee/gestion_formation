<?php

namespace App\Http\Controllers;

use App\Exports\FormationExport;
use App\Http\Controllers\Controller;
use App\Imports\FormationImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FormationController extends Controller
{
    public function fileImportExport()
    {
        return view('file-import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileImport(Request $request)
    {
        Excel::import(new FormationImport, $request->file('file')->store('temp'));
        return back();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileExport(Request $request)
    {
        return Excel::download(new FormationExport, 'employee-collection.xlsx');
    }
}
