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

Route::get('file-import-export', [FormationController::class, 'fileImportExport'])->name('file-import-export');
Route::post('formation-import', [FormationController::class, 'formationImport'])->name('formation-import');
Route::get('formation-export', [FormationController::class, 'formationExport'])->name('formation-export');
Route::post('stage-import', [StageController::class, 'stageImport'])->name('stage-import');
Route::get('stage-export', [StageController::class, 'stageExport'])->name('stage-export');
Route::post('salarie-import', [SalarieController::class, 'salarieImport'])->name('salarie-import');
Route::get('salarie-export', [SalarieController::class, 'salarieExport'])->name('salarie-export');
Route::post('bergerie-import', [BergerieController::class, 'bergerieImport'])->name('bergerie-import');


Route::get('/', function () {
    return view('welcome');
});
