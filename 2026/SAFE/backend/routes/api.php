<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\AutorizacoesController;
use App\Http\Controllers\Api\PortariaController;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/autorizacoes', [AutorizacoesController::class, 'index']);
Route::post('/autorizacoes', [AutorizacoesController::class, 'store']);
Route::post('/autorizacoes/{id}/validar', [PortariaController::class, 'validar']); // Ajustado para PortariaController@validar

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
