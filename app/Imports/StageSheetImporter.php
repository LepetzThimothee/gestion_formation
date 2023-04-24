<?php

namespace App\Imports;

use App\Models\Formation;
use App\Models\Stage;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use PHPUnit\Exception;

class StageSheetImporter implements ToModel
{
    public function getFormationId($val) {
        $formationId = null;
        if ($val != null) {
            $formation = Formation::whereOrganisme($val)->get();
            if (count($formation->all())!=0) $formationId = $formation->all()[0]->id;
        }
        return $formationId;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Stage([
            'session' => $row[0],
            'intitule' => $row[1],
            'numero' => $row[2],
            'formation_id' => $this->getFormationId($row[3]),
            'organisme' => $row[3],
            'formation_obligatoire' => $row[4],
            'intra_inter' => $row[5],
            'cout_pedagogique' => $row[6],
            'debut_formation' => $row[7],
            'fin_formation' =>  $row[8],
            'duree' => $row[9],
            'opco' => $row[10],
            'convention' => $row[11],
            'convocation' => $row[12],
            'attestation' => $row[13],
            'facture' => $row[14],
        ]);
    }
}
