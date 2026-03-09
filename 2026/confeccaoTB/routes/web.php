<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;    
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\ProdutoController;

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


/*--------------------------
CRUD CLIENTES 
--------------------------*/
// rota de clientes
Route::get('/clientes', [ClienteController::class,'index'])->name('clientes.index');
// Rota para mostrar o formulário 
Route::get('/clientes/create',[ClienteController::class,'create'])->name('clientes.create');

Route::get('/clientes/edit', [ClienteController::class, 'edit'])->name('clientes.edit');

// Rota para RECEBER os dados e salvar (POST)
Route::post('/clientes',[ClienteController::class,'store'])->name('clientes.store');

/*--------------------------
CRUD PEDIDO 
--------------------------*/
// rota de pedidos
Route::get('/pedido' ,[PedidoController::class, 'index'])->name('pedido.index');

Route::get('/pedido/create',[PedidoController::class,'create'])->name('pedido.create');

Route::post('/pedido',[PedidoController::class,'store'])->name('pedido.store');

/*-------------------------
CRUD PRODUTO 
--------------------------*/
//rota de produtos 
Route::get('/produto', [ProdutoController::class,'index'])->name('produto.index');

Route::get('/produto/create',[ProdutoController::class,'create'])->name('produto.create');

Route::post('/produto',[ProdutoController::class,'store'])->name('produto.store');

/*-------------------------
CRUD FORNECEDORES
--------------------------*/
// rota de fornecedor
Route::get('/fornecedor' ,[FornecedorController::class,'index'])->name('fornecedor.index');

Route::get('/fornecedor/create',[FornecedorController::class,'create'])->name('fornecedor.create');

Route::post('/fornecedor',[FornecedorController::class,'store'])->name('fornecedor.store');
/*-------------------------
CRUD ESTOQUE
--------------------------*/

//rota de estoque 
Route::get('/estoque',[EstoqueController::class,'index'])->name('estoque.index');

Route::get('/estoque/create',[EstoqueController::class,'create'])->name('estoque.create');

Route::post('/estoque',[EstoqueController::class,'store'])->name('estoque.store');