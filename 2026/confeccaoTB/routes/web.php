<?php

use App\Http\Controllers\ProfileController;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;    
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\EstoqueController;
require __DIR__.'/auth.php';
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// rota de clientes
Route::get('/clientes', [ClienteController::class,'index'])->name('clientes.index');
// rota de pedidos
Route::get('/pedido' ,[PedidoController::class, 'index'])->name('pedido.index');
// rota de fornecedor
Route::get('/fornecedor' ,[FornecedorController::class,'index'])->name('fornecedor.index');
//rota de estoque 
Route::get('/estoque',[EstoqueController::class,'index'])->name('estoque.index');




