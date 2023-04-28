<?php

namespace App\Http\Controllers;

use App\Exports\MultiSheetSelectorExport;
use App\Http\Controllers\Controller;
use App\Imports\MultiSheetSelectorImport;
use App\Models\Formation;
use App\Models\Salarie;
use App\Models\Stage;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BergerieController extends Controller
{
    public function fileImportExport()
    {
        return view('formation-import-export');
    }

    public function bergerieImport(Request $request)
    {
        // On vide les tables
        Salarie::truncate();
        Stage::truncate();
        Formation::truncate();
        $bergerie = new MultiSheetSelectorImport();
        $bergerie->onlySheets("Organismes de formation","Salariés","Stage");
        Excel::import($bergerie, $request->file('file'));
        return redirect('/file-import-export')->with('status', 'Bergerie Importé avec succès!');
    }

    public function bergerieExport()
    {
        return Excel::download(new MultiSheetSelectorExport, 'bergerie.xlsx');
    }
}
