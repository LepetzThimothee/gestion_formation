<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->insert([

            [
                'session' => 220146,
                'matricule' => 1002,
                'salaire_impute' => false,
                'nombre_heures_realisees' => 7,
                'nombre_stagiaires' => 2,
                'cout_pedagogique_stagiaire' => 2175,
                'transport' => 0,
                'hebergement' => 0,
                'restauration' => 12.10,
                'total' => 2185.10,
            ],
            [
                'session' => 220146,
                'matricule' => 1005,
                'salaire_impute' => false,
                'nombre_heures_realisees' => 7,
                'nombre_stagiaires' => 2,
                'cout_pedagogique_stagiaire' => 2175,
                'transport' => 0,
                'hebergement' => 0,
                'restauration' => 0,
                'total' => 2175,
            ]
        ]);
    }
}
