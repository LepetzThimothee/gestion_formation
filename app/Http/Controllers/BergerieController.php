<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\MultiSheetSelector;
use App\Models\Formation;
use App\Models\Salarie;
use App\Models\Stage;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BergerieController extends Controller
{
    public function BergerieImport(Request $request)
    {
        // On vide les tables
        Salarie::truncate();
        Stage::truncate();
        Formation::truncate();
        $bergerie = new MultiSheetSelector();
        $bergerie->onlySheets("Organismes de formation","Salariés","Stage");
        Excel::import($bergerie, $request->file('file'));
        return redirect('/file-import-export')->with('success', 'Bergerie Import Successfully!');
    }


}
