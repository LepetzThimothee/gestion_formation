<?php

namespace App\Imports;

use App\Models\Formation;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

/**
 * Classe d'importation des formations.
 * Elle permet de convertir les lignes en modèles de formation.
 * Elle prend en charge les en-têtes de colonnes et effectue des mises à jour si les enregistrements existent déjà.
 */
class FormationSheetImporter implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * Retourne la clé unique utilisée pour les opérations de mise à jour ou d'insertion.
     *
     * @return string
     */
    public function uniqueBy(): string
    {
        return 'siret';
    }

    /**
     * Crée une instance de Formation à partir d'un tableau de données qui représente les lignes du fichier Excel
     *
     * @param array $row
     * @return Model|null
     */
    public function model(array $row): Formation|null
    {
        // Cela va nous permettre de vérifier si toutes les colonnes spécifiées sont nulles
        $colonnes = [
            'organimes_de_formation',
            'coordonnees_telephoniques',
            'adresses_mail',
            'numero_declaration_existence',
            'numero_de_siret',
            'adresse',
            'interlocuteur',
        ];

        foreach ($colonnes as $column) {
            // On vérifie si la colonne n'est pas nulle
            if (!is_null($row[$column])) {
                $formation = null;

                // Vérification et traitement du numéro de SIRET
                $siret = $row['numero_de_siret'];
                if($siret) {
                    if (trim($siret) === '') {
                        $siret = null;
                    }
                }

                // Si le numéro de SIRET est null, on recherche une formation par organisme à partir de son intitulé
                if (is_null($siret)) {
                    $formation = Formation::whereOrganisme($row['organimes_de_formation'])->first();
                }

                // Si une formation a été trouvée, on retourne null pour ignorer cette ligne
                if ($formation) {
                    return null;
                }

                // Création d'une nouvelle instance de Formation et assignation des valeurs des colonnes
                $formation = new Formation();
                $formation->organisme = $row['organimes_de_formation'];
                $formation->telephone = $row['coordonnees_telephoniques'];
                $formation->email = $row['adresses_mail'];
                $formation->numero_declaration_existence = $row['numero_declaration_existence'];
                $formation->siret = $row['numero_de_siret'];
                $formation->adresse = $row['adresse'];
                $formation->interlocuteur = $row['interlocuteur'];

                return $formation;
            }
        }

        // Toutes les colonnes spécifiées sont nulles, on retourne null
        return null;
    }
}
