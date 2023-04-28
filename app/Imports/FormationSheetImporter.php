<?php

namespace App\Imports;

use App\Models\Formation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class FormationSheetImporter implements ToModel
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
            'organisme' => $row[0],
            'telephone' => $row[1],
            'email' => $row[2],
            'numero_declaration_existence' => $row[3],
            'siret' => $row[4],
            'adresse' => $row[5],
            'interlocuteur' => $row[6],
        ]);
    }
}
