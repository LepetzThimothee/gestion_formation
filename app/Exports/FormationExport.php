<?php

namespace App\Exports;

use App\Models\Formation;
use Maatwebsite\Excel\Concerns\FromCollection;

class FormationExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Formation::get(['organisme','telephone','email',
            'numero_declaration_existence','siret','adresse','interlocuteur']);
    }

    public function headings() {
        return ["organismes de formation","coordonnées téléphoniques","adresses mail","Numéro déclaration existence",
            "Numéro de SIRET","adresse","Interlocuteur"];
    }
}
