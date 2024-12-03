<?php

use App\Http\Controllers\FotoController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FotoController::class, 'index'])->name('foto.index');
Route::get('/imagen/create', [FotoController::class, 'create'])->name('foto.create');
Route::post('/imagen', [FotoController::class, 'store'])->name('foto.store');
Route::get('/imagen/{id}', [FotoController::class, 'show'])->name('foto.show');
Route::get('/imagen/ver/{photo}', [FotoController::class, 'view'])->name('foto.view');

Route::delete('/subir/{id}', [FotoController::class, 'destroy'])->name('foto.destroy');

Route::get('/fotos/lista', [FotoController::class, 'lista'])->name('foto.lista');




