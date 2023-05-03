<?php

namespace App\Exports;

use App\Models\Formation;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class FormationSheetExporter implements FromCollection, WithHeadings, WithTitle
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Formation::get(['organisme','telephone','email',
            'numero_declaration_existence','siret','adresse','interlocuteur']);
    }

    public function headings(): array {
        return ["organismes de formation","coordonnées téléphoniques","adresses mail","Numéro déclaration existence",
            "Numéro de SIRET","adresse","Interlocuteur"];
    }

    public function title(): string
    {
        return "Organismes de formation";
    }
}
