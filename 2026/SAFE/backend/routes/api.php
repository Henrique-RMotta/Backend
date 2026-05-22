<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutorizacaoController;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/autorizacoes', [AutorizacaoController::class, 'index']);
Route::post('/autorizacoes', [AutorizacaoController::class, 'store']);
Route::post('/autorizacoes/{id}/validar', [AutorizacaoController::class, 'validar']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
