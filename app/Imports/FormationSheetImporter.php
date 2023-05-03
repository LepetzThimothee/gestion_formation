<?php

namespace App\Imports;

use App\Models\Formation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FormationSheetImporter implements ToModel, WithHeadingRow
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Formation([
            'organisme' => $row['organimes_de_formation'],
            'telephone' => $row['coordonnees_telephoniques'],
            'email' => $row['adresses_mail'],
            'numero_declaration_existence' => $row['numero_declaration_existence'],
            'siret' => $row['numero_de_siret'],
            'adresse' => $row['adresse'],
            'interlocuteur' => $row['interlocuteur'],
        ]);
    }
}
