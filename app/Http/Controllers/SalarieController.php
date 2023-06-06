<?php

namespace App\Http\Controllers;

use App\Exports\SalarieSheetExporter;
use App\Imports\MultiSheetSelectorImport;
use App\Models\Salarie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SalarieController extends Controller
{
    /**
     * Affiche la liste des salariés.
     *
     * @return View
     */
    public function index(): View
    {
        $salaries = Salarie::all();
        return view('salaries.index', ['salaries' => $salaries]);
    }

    /**
     * Importe les salariés à partir d'un fichier Excel.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function salarieImport(Request $request): RedirectResponse
    {
        if ($request->hasFile('file')) {
            $salarie = new MultiSheetSelectorImport();
            $salarie->onlySheets('Salariés');
            Excel::import($salarie, $request->file('file'));
            return redirect('/file-import-export')->with('status', 'Salariés importés avec succès!');
        } else {
            return redirect('/file-import-export')->with('error', 'Aucun fichier n\'a été sélectionné.');
        }
    }

    /**
     * Exporte les salariés vers un fichier Excel.
     *
     * @return BinaryFileResponse
     */
    public function salarieExport(): BinaryFileResponse
    {
        return Excel::download(new SalarieSheetExporter, 'salarie.xlsx');
    }
}
