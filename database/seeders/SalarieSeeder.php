<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class SalarieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('salaries')->insert([
            [
                'matricule' => 1005,
                'nom' => "dupont5",
                'nom_jeune_fille' => "durant5",
                'prenom' => "laurent5",
                'code_etablissement' => "DG",
                'sexe' => "F",
                'naissance' => Date::create(1958,1,5)->format("d/m/y"),
                'age' => 61,
                'numero_secu' => 512541231235412,
                'domiciliation_bancaire' => "banque5",
                'iban' => "FR1238",
                'bic' => "azerty5",
                'email_perso' => "toto@1238",
                'email_pro' => "coco@1238",
                'adresse_ligne1' => "7 rue du pont",
                'adresse_ligne2' => "8 rue leon blum",
                'adresse_ligne3' => "59354 saint andre",
                'adresse_ligne4' => "59354 saint andre",
                'nature_contrat' => 2,
                'type_contrat' => 1,
                'puissance_fiscal' => "A05",
                'referent_paie' => "G04",
                'unite' => "2350",
                'lib_unite' => "DIR. technique - gest du patrimoine",
                'section_analytique' => "DG102000",
                'debut_anciennete_groupe' => Date::create(1984,12,1)->format("d/m/y"),
                'debut_contrat' => Date::create(1984,12,1)->format("d/m/y"),
                'fin_contrat' => Date::create(2022,1,12)->format("d/m/y"),
                'filiere' => "filiere logistique",
                'sous_filiere' => "rm-cadres logistiques",
                'metier' => "metier chef de service technique",
                'emploi' => "responsable dpt logistique",
                'statut' => "cadre",
                'rpps' => null,
                'adeli' => null,
                'cpn' => "cadre 4/4bis",
                'taux_emploi' => 90,
                'horaire_contrat' => 136.5,
                'montant_aq004' => 0,
                'taux_horaire' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'matricule' => 1002,
                'nom' => "dupont2",
                'nom_jeune_fille' => null,
                'prenom' => "laurent2",
                'code_etablissement' => "HB",
                'sexe' => "M",
                'naissance' => Date::create(1958,1,2)->format("d/m/y"),
                'age' => 55,
                'numero_secu' => 220213145224312,
                'domiciliation_bancaire' => "banque2",
                'iban' => "FR1235",
                'bic' => "azerty2",
                'email_perso' => "toto@1235",
                'email_pro' => "coco@1235",
                'adresse_ligne1' => "4 rue du pont",
                'adresse_ligne2' => "5 rue leon blum",
                'adresse_ligne3' => "59351 saint andre",
                'adresse_ligne4' => "59351 saint andre",
                'nature_contrat' => 2,
                'type_contrat' => 1,
                'puissance_fiscal' => "A07",
                'referent_paie' => "R03",
                'unite' => "2065",
                'lib_unite' => "imagerie medicale",
                'section_analytique' => "HB403000",
                'debut_anciennete_groupe' => Date::create(1990,9,10)->format("d/m/y"),
                'debut_contrat' => Date::create(1990,10,1)->format("d/m/y"),
                'fin_contrat' => null,
                'filiere' => "filiere soignante",
                'sous_filiere' => "rm-encadrant de soins",
                'metier' => "metier encadrant d'unite de soins",
                'emploi' => "infirmier major",
                'statut' => "cadre",
                'rpps' => null,
                'adeli' => "626123509",
                'cpn' => "article 36",
                'taux_emploi' => 100,
                'horaire_contrat' => 151.67,
                'montant_aq004' => 3853.16,
                'taux_horaire' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
