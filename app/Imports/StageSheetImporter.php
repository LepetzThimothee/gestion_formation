<?php

namespace App\Imports;

use App\Models\Formation;
use App\Models\Stage;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use PHPUnit\Exception;

class StageSheetImporter implements ToModel, WithHeadingRow, WithUpserts
{
    public function getFormationId($val) {
        $formationId = null;
        if ($val != null) {
            $formation = Formation::whereOrganisme($val)->get();
            if (count($formation->all())!=0) $formationId = $formation->all()[0]->id;
        }
        return $formationId;
    }

    public function intToDate($val) {
        if (getType($val) == getType(0)) {
            $val = Date::create(1900,1,0)
                ->addDays($val-1) // On ajoute le nombre de jours donné à 01/01/1900 qui est le système de date de Excel
                ->format("d/m/Y");
        }
        return $val;
    }

    /**
     * Retourne la clé unique utilisée pour les opérations de mise à jour ou d'insertion.
     *
     * @return string|array
     */
    public function uniqueBy()
    {
        return 'session';
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (is_null($row['cession'])) {
            return null;
        }

        return new Stage([
            'session' => $row['cession'],
            'intitule' => $row['intitule_de_formation'],
            'formation_id' => $this->getFormationId($row['organisme_de_formation']),
            'organisme' => $row['organisme_de_formation'],
            'formation_obligatoire' => $row['formation_obligatoireon'],
            'intra_inter' => $row['intrainter_ar'],
            'cout_pedagogique' => $row['cout_pedagogique_stage'],
            'debut_formation' => $this->intToDate($row['date_de_debut_de_formation']),
            'fin_formation' => $this->intToDate($row['date_de_fin_de_formation']),
            'duree' => $row['duree_reelle_de_la_formation_en_heures'],
            'opco' => $row['prise_en_charge_opco_sante_on'],
            'convention' => $row['convention_de_formation_on'],
            'convocation' => $row['convocation_on'],
            'attestation' => $row['attestation_on'],
            'facture' => $row['facture_on'],
        ]);
    }

    /**
     * Renvoie le numéro de ligne d'en-tête dans le fichier Excel.
     *
     * @return int Le numéro de ligne d'en-tête.
     */
    public function headingRow(): int
    {
        return 3;
    }
}
