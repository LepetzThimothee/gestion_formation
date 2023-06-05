<?php

namespace App\Imports;

use App\Models\Formation;
use App\Models\Stage;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

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
        if (is_numeric($val)) {
            $val = Carbon::create(1900,1,0)
                ->addDays($val-1) // On ajoute le nombre de jours donné à 01/01/1900 qui est le système de date de Excel
                ->format("d/m/Y");
        }
        return $val;
    }

    /**
     * Permet de vérifier et convertir une valeur en cas de besoin.
     *
     * @param mixed $valeur La valeur à vérifier et convertir.
     * @return float La valeur convertie.
     */
    public function verificationValeur(mixed $valeur): float
    {
        if ($valeur === null) {
            return 0; // La valeur est null, donc on l'a définis à 0.
        }

        // On supprime les espaces au début et à la fin de la valeur.
        $valeur = trim($valeur);

        // On vérifie si la valeur est vide après suppression des espaces.
        if (empty($valeur)) {
            $valeur = 0; // La valeur est vide, donc on l'a définis à 0.
        } elseif (!is_numeric($valeur)) {
            // La valeur n'est pas numérique, il s'agit d'une expression à évaluer
            $valeur = ltrim($valeur, '='); // On supprime le préfixe "="
            $valeur = eval("return $valeur;"); // Et enfin on évalue l'expression
        }

        return $valeur;
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
        if (!is_numeric($row['cession'])) {
            return null;
        }

        return new Stage([
            'session' => $row['cession'],
            'intitule' => $row['intitule_de_formation'],
            'formation_id' => $this->getFormationId($row['organisme_de_formation']),
            'organisme' => $row['organisme_de_formation'],
            'formation_obligatoire' => $row['formation_obligatoireon'],
            'intra_inter' => $row['intrainter_ar'],
            'cout_pedagogique' => $this->verificationValeur($row['cout_pedagogique_stage']),
            'debut_formation' => $this->intToDate($row['date_de_debut_de_formation']),
            'fin_formation' => $this->intToDate($row['date_de_fin_de_formation']),
            'duree' => $this->verificationValeur($row['duree_reelle_de_la_formation_en_heures']),
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
