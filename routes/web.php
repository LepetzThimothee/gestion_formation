<?php

use App\Http\Controllers\BergerieController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\SalarieController;
use App\Http\Controllers\StageController;
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

Route::get('file-import-export', [BergerieController::class, 'fileImportExport'])->name('file-import-export');

Route::prefix('import')->group(function () {
    Route::post('formation', [FormationController::class, 'formationImport'])->name('formation-import');
    Route::post('stage', [StageController::class, 'stageImport'])->name('stage-import');
    Route::post('salarie', [SalarieController::class, 'salarieImport'])->name('salarie-import');
    Route::post('bergerie', [BergerieController::class, 'bergerieImport'])->name('bergerie-import');
});

Route::prefix('export')->group(function () {
    Route::get('formation', [FormationController::class, 'formationExport'])->name('formation-export');
    Route::get('stage', [StageController::class, 'stageExport'])->name('stage-export');
    Route::get('salarie', [SalarieController::class, 'salarieExport'])->name('salarie-export');
    Route::get('bergerie', [BergerieController::class, 'bergerieExport'])->name('bergerie-export');
});

Route::resource('formations', FormationController::class);
