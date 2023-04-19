<?php

namespace Database\Seeders;

use App\Models\Formation;
use App\Models\Stage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formations = Formation::all();
        DB::table('stages')->insert([
            [
                'session' => 220146,
                'formation_id' => 1,
                'intitule' => "domotique et controle",
                'numero' => null,
                'organisme' => "",
                'formation_obligatoire' => false,
                'intra_inter' => "R",
                'cout_pedagogique' => 4350,
                'debut_formation' => Date::create(2022,9,30)->format("d/m/y"),
                'fin_formation' => Date::create(2022,10,1)->format("d/m/y"),
                'duree' => 7,
                'opco' => true,
                'convention' => true,
                'convocation' => true,
                'attestation' => true,
                'facture' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'session' => 220175,
                'formation_id' => 2,
                'intitule' => "du raisonnement clinique",
                'numero' => null,
                'organisme' => "",
                'formation_obligatoire' => false,
                'intra_inter' => "R",
                'cout_pedagogique' => 3970,
                'debut_formation' => Date::create(2022,10,14)->format("d/m/y"),
                'fin_formation' => Date::create(2022,10,15)->format("d/m/y"),
                'duree' => 14,
                'opco' => true,
                'convention' => true,
                'convocation' => true,
                'attestation' => true,
                'facture' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        foreach ($formations as $formation) {
            DB::table('stages')->where('formation_id',$formation->id)->update(['organisme' => $formation->organisme]);
        }
    }
}
