<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('hola-mundo', function () {
    return Inertia::render('HolaMundo');
})->middleware(['auth', 'verified'])->name('hola-mundo');

Route::get('contador', function () {
    return Inertia::render('Contador');
})->middleware(['auth', 'verified'])->name('contador');

//Inertia.js
Route::get('categoria', function () {
    return Inertia::render('Categoria');
})->middleware(['auth', 'verified'])->name('categoria');

Route::get('categorias-data', [CategoriaController::class, 'listarCategoria']);
Route::post('categorias-data', [CategoriaController::class, 'guardarCategoria']);
Route::put('categorias-data/{id_categoria}', [CategoriaController::class, 'editarCategoria']);
Route::delete('categorias-data/{id_categoria}', [CategoriaController::class, 'eliminarCategoria']);

//Exportar en pdf
Route::get('categorias-data-pdf', [CategoriaController::class, 'exportarPdfCategoria']);

require __DIR__ . '/settings.php';
