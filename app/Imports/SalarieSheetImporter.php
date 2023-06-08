<?php

namespace App\Imports;

use App\Models\Salarie;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

/**
 * Classe d'importation des salariés.
 * Elle permet de convertir les lignes en modèles de salarié.
 * Elle prend en charge les en-têtes de colonnes et effectue des mises à jour si les enregistrements existent déjà.
 */
class SalarieSheetImporter implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * Convertit une valeur en date Excel en format date
     *
     * @param mixed $val La valeur à convertir
     * @return mixed La valeur convertie en format date (d/m/Y) ou la valeur d'origine si elle n'est pas numérique
     */
    public function intToDate(mixed $val): mixed
    {
        if (is_numeric($val)) {
            $val = Carbon::create(1900,1,0)
                ->addDays($val-1) // On ajoute le nombre de jours donné à 01/01/1900 qui est le système de date de Excel
                ->format("d/m/Y");
        }
        return $val;
    }

    /**
     * Retourne la clé unique utilisée pour les opérations de mise à jour ou d'insertion.
     *
     * @return string
     */
    public function uniqueBy(): string
    {
        return 'matricule';
    }

    /**
     * Crée une instance de Salarié à partir d'un tableau de données qui représente les lignes du fichier Excel
     *
     * @param array $row
     * @return Salarie|null
     */
    public function model(array $row): Salarie|null
    {
        if (is_null($row['matricule']) || is_null($row['nom_de_famil_le_de_lagen']) || is_null($row["prenom_de_l_agent"])) {
            return null; // On retourne null si la ligne du matricule, du nom ou du prénom est null
        }
        return new Salarie([
            'matricule' => $row['matricule'],
            'nom' => $row['nom_de_famil_le_de_lagen'],
            'nom_jeune_fille' => $row['nom_de_jeune_fille_agent'],
            'prenom' => $row["prenom_de_l_agent"],
            'code_etablissement' => $row['code_etablis_sement'],
            'sexe' => $row["code_sexe_de_lagent"],
            'naissance' => $this->intToDate($row['date_de_naissance']),
            'age' => $row['age_salarie'],
            'numero_secu' => $row['num_securite_sociale'],
            'domiciliation_bancaire' => $row['domiciliatio_n_bancaire'],
            'iban' => $row['code_iban'],
            'bic' => $row['bic'],
            'email_perso' => $row['e_mail_perso'],
            'email_pro' => $row['e_mail_pro'],
            'adresse_ligne1' => $row['ligne_1_de_l_adresse'],
            'adresse_ligne2' => $row['ligne_2_de_l_adresse'],
            'adresse_ligne3' => $row['ligne_3_de_l_adresse'],
            'adresse_ligne4' => $row['ligne_4_de_l_adresse'],
            'nature_contrat' => $row['nature_du_contrat'],
            'type_contrat' => $row['type_contrat'],
            'puissance_fiscal' => $row['puis_fiscal_vehicule'],
            'referent_paie' => $row['referent_pai_e'],
            'unite' => $row['unite'],
            'lib_unite' => $row['lib_unite'],
            'section_analytique' => $row['section_analytique'],
            'debut_anciennete_groupe' => $this->intToDate($row['debut_ancien_nete_groupe']),
            'debut_contrat' => $this->intToDate($row['date_debut_contrat']),
            'fin_contrat' => $this->intToDate($row['date_fin_contrat']),
            'filiere' => $row['filiere'],
            'sous_filiere' => $row['sous_filiere'],
            'metier' => $row['metier'],
            'emploi' => $row['emploi'],
            'statut' => $row['statut'],
            'rpps' => $row['numero_rpps'],
            'adeli' => $row['n0_adeli'],
            'cpn' => $row['code_cpn'],
            'taux_emploi' => $row['taux_emploi'],
            'horaire_contrat' => $row['horaire_contract'],
            'montant_aq004' => $row['montant_aq004'],
            'taux_horaire' => $row['taux_hor'],
        ]);
    }
}
