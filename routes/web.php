<?php

use App\Http\Controllers\FormationController;
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
Route::post('file-import', [FormationController::class, 'fileImport'])->name('file-import');
Route::get('file-export', [FormationController::class, 'fileExport'])->name('file-export');


Route::get('/', function () {
    return view('welcome');
});
