<?php

namespace Database\Seeders;

use App\Models\Formation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Formation::factory([
            'organisme' => "centre de formation de l'ahnac",
            'telephone' => "03.21.79.11.69",
            'email' => "scaty@ahnac.com",
            'numero_declaration_existence' => "31620009962",
            'siret' => "31245483800102",
            'adresse' => "9 place de la 4ème république 62590 OIGNIES",
            'interlocuteur' => "louis1",
        ])->create();
        Formation::factory([
            'organisme' => "alister",
            'telephone' => "03.89.54.94.34",
            'email' => "info@alister,org",
            'numero_declaration_existence' => "42680030268",
            'siret' => "33816479100034",
            'adresse' => "26 rue du Docteur Léon Mangeney 68100 MULHOUSE",
            'interlocuteur' => "louis2",
        ])->create();
    }
}
