<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PokemonController;
use App\Http\Controllers\PokedexController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/pokedex', [PokemonController::class, 'index'])->name('pokemon.index');
Route::get('/pokedex/create',[PokedexController::class,'create'])->name('pokemon.create');
Route::post('/pokedex/store',[PokedexController::class,'store'])->name('pokemon.store');