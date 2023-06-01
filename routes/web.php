<?php

use App\Http\Controllers\PlanController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\SalarieController;
use App\Http\Controllers\StageController;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('file-import-export', function(){return view('formation-import-export');})->name('file-import-export');

Route::prefix('import')->group(function () {
    Route::post('formation', [FormationController::class, 'formationImport'])->name('formation-import');
    Route::post('stage', [StageController::class, 'stageImport'])->name('stage-import');
    Route::post('salarie', [SalarieController::class, 'salarieImport'])->name('salarie-import');
    Route::post('bergerie', [PlanController::class, 'planImport'])->name('plan-import');
});

Route::prefix('export')->group(function () {
    Route::get('formation', [FormationController::class, 'formationExport'])->name('formation-export');
    Route::get('stage', [StageController::class, 'stageExport'])->name('stage-export');
    Route::get('salarie', [SalarieController::class, 'salarieExport'])->name('salarie-export');
    Route::get('bergerie', [PlanController::class, 'planExport'])->name('plan-export');
});

Route::resource('formations', FormationController::class);
Route::resource('stages', StageController::class);
Route::resource('salaries',SalarieController::class);
Route::resource('plan', PlanController::class);

Route::post('/update-charges-patronales', function(Request $request) {
    // On récupère la nouvelle valeur de charges patronales depuis le formulaire
    $nouvelle_charges_patronales = $request->input('charges_patronales');

    // On met à jour la variable "charges_patronales" dans le cache
    Cache::put('charges_patronales', $nouvelle_charges_patronales);

    // On récupère tous les plans avec les salariés associés
    $plans = Plan::with('salaries')->get();

    // On parcourt chaque plan et on met à jour le total en utilisant les nouvelles charges patronales
    foreach ($plans as $plan) {
        $salaries = $plan->salaries;

        foreach ($salaries as $salarie) {
            $transport = $salarie->pivot->transport;
            $hebergement = $salarie->pivot->hebergement;
            $restauration = $salarie->pivot->restauration;
            $nombre_heures_realisees = $salarie->pivot->nombre_heures_realisees;
            $cout_pedagogique_stagiaire = $plan->cout_pedagogique_stagiaire;
            $charges_patronales = Cache::get('charges_patronales');

            $total = ($charges_patronales * $salarie->taux_horaire * $nombre_heures_realisees) + $cout_pedagogique_stagiaire + $transport + $hebergement + $restauration;

            // On met à jour le total dans la table pivot
            $salarie->pivot->total = $total;
            $salarie->pivot->save();
        }
    }

    // Rediriger l'utilisateur vers la page d'accueil ou une autre page de votre choix
    return redirect('/')->with('status', "Charges patronales modifiées avec succès");
});
