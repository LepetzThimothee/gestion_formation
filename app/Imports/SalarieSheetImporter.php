<?php

namespace App\Imports;

use App\Models\Salarie;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class SalarieSheetImporter implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * Retourne la clé unique utilisée pour les opérations de mise à jour ou d'insertion.
     *
     * @return string|array
     */
    public function uniqueBy()
    {
        return 'matricule';
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Salarie([
            'matricule' => $row['matricule'],
            'nom' => $row['nom_de_famil_le_de_lagen'],
            'nom_jeune_fille' => $row['nom_de_jeune_fille_agent'],
            'prenom' => $row["prenom_de_l_agent"],
            'code_etablissement' => $row['code_etablis_sement'],
            'sexe' => $row["code_sexe_de_lagent"],
            'naissance' => $row['date_de_naissance'],
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
            'debut_anciennete_groupe' => $row['debut_ancien_nete_groupe'],
            'debut_contrat' => $row['date_debut_contrat'],
            'fin_contrat' => $row['date_fin_contrat'],
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
        return $salarie;
    }
}
