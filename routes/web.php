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

Route::get('file-import-export', [PlanController::class, 'fileImportExport'])->name('file-import-export');

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
    // Récupérer la nouvelle valeur de charges patronales depuis le formulaire
    $nouvelle_charges_patronales = $request->input('charges_patronales');

    // Mettre à jour la variable globale "charges_patronales" dans le fichier config/app.php
    Cache::put('charges_patronales', $nouvelle_charges_patronales);

    $plans = Plan::with('salaries')->with('stage')->get();

    // Rediriger l'utilisateur vers la page d'accueil ou une autre page de votre choix
    return redirect('/')->with('status', "Charges patronales modifié avec succès");
});
