<?php

namespace App\Imports;

use App\Models\Plan;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

/**
 * Classe d'importation du plan.
 * Elle permet de convertir les lignes en modèles de plan.
 * Elle prend en charge les en-têtes de colonnes et effectue des insertions par lots, en lisant les données par petits morceaux.
 */
class PlanSheetImporter implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
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
     * Crée une instance de Plan à partir d'un tableau de données qui représente les lignes du fichier Excel
     *
     * @param array $row
     * @return Model|null
     */
    public function model(array $row): Model|null
    {
        if (is_null($row['session']) || is_null($row['matricule'])) {
            return null; // Retourne null si les valeurs session ou matricule sont nulles
        }

        $stage_id = Stage::whereSession($row['session'])->first()->id;
        $plan = Plan::whereStageId($stage_id)->first();
        if(!$plan) {
            $plan = new Plan([
                'stage_id' => $stage_id,
                'nombre_stagiaires' => 0,
                'cout_pedagogique_stagiaire' => 0
            ]);
            $plan->save();
        }

        $salarie = [$row['matricule']];
        $salariesExistants = $plan->salaries->pluck('matricule')->toArray();
        $salarieAjouter = array_diff($salarie, $salariesExistants);

        if (!empty($salarieAjouter)) {
            $plan->salaries()->attach($salarieAjouter, [
                'nombre_heures_realisees' => $this->verificationValeur($row['nombres_dheures_realisees']),
                'transport' => $this->verificationValeur($row['transport']),
                'hebergement' => $this->verificationValeur($row['hebergement']),
                'restauration' => $this->verificationValeur($row['restauration']),
                'total' => 0,
            ]);
        }
        $plan->save();
        return null;
    }

    /**
     * Renvoie le numéro de ligne d'en-tête dans le fichier Excel.
     *
     * @return int Le numéro de ligne d'en-tête.
     */
    public function headingRow(): int
    {
        return 5;
    }

    /**
     * Permet de spécifier la taille du lot d'insertions à effectuer à la fois.
     *
     * @return int La taille du lot d'insertions.
     */
    public function batchSize(): int
    {
        return 1000;
    }

    /**
     * Permet de spécifier la taille de chaque "chunk" ou bloc de lignes à lire et à traiter à la fois.
     *
     * @return int La taille du bloc de lignes.
     */
    public function chunkSize(): int
    {
        return 1000;
    }
}
