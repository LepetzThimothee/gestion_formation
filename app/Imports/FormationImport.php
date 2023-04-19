<?php

namespace App\Imports;

use App\Models\Formation;
use Maatwebsite\Excel\Concerns\ToModel;

class FormationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Formation([
            'organisme' => $row[1],
            'telephone' => $row[2],
            'email' => $row[3],
            'numero_declaration_existence' => $row[4],
            'siret' => $row[5],
            'adresse' => $row[6],
            'interlocuteur' => $row[7],
        ]);
    }
}
