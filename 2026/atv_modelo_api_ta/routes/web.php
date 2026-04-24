<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PokemonController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pokedex', [PokemonController::class, 'index'])->name('pokemon.index');