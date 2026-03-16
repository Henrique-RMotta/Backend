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
// Rota para abrir o formulario de editar
Route::get('/clientes/edit/{cliente}', [ClienteController::class, 'edit'])->name('clientes.edit');
// Rota para atualizar o cliente 
Route::put('/clientes/update/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
// Rota para apagar o cliente 
Route::delete('/clientes/destroy/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
// Rota para RECEBER os dados e salvar (POST)
Route::post('/clientes',[ClienteController::class,'store'])->name('clientes.store');

/*--------------------------
CRUD PEDIDO 
--------------------------*/
// rota de pedidos
Route::get('/pedido' ,[PedidoController::class, 'index'])->name('pedido.index');

Route::get('/pedido/create',[PedidoController::class,'create'])->name('pedido.create');
// Rota para abrir o formulario de editar
Route::get('/pedido/edit/{pedido}', [PedidoController::class, 'edit'])->name('pedido.edit');
// Rota para atualizar o pedido 
Route::put('/pedido/update/{pedido}', [PedidoController::class, 'update'])->name('pedido.update');
// Rota para apagar o pedido 
Route::delete('/pedido/destroy/{pedido}', [PedidoController::class, 'destroy'])->name('pedido.destroy');

Route::post('/pedido',[PedidoController::class,'store'])->name('pedido.store');

/*-------------------------
CRUD PRODUTO 
--------------------------*/
//rota de produtos 
Route::get('/produto', [ProdutoController::class,'index'])->name('produto.index');

Route::get('/produto/create',[ProdutoController::class,'create'])->name('produto.create');
// Rota para abrir o formulario de editar
Route::get('/produto/edit/{produto}', [ProdutoController::class, 'edit'])->name('produto.edit');
// Rota para atualizar o produto 
Route::put('/produto/update/{produto}', [ProdutoController::class, 'update'])->name('produto.update');
// Rota para apagar o produto 
Route::delete('/produto/destroy/{produto}', [ProdutoController::class, 'destroy'])->name('produto.destroy');

Route::post('/produto',[ProdutoController::class,'store'])->name('produto.store');

/*-------------------------
CRUD FORNECEDORES
--------------------------*/
// rota de fornecedor
Route::get('/fornecedor' ,[FornecedorController::class,'index'])->name('fornecedor.index');

Route::get('/fornecedor/create',[FornecedorController::class,'create'])->name('fornecedor.create');
// Rota para abrir o formulario de editar
Route::get('/fornecedor/edit/{fornecedor}', [FornecedorController::class, 'edit'])->name('fornecedor.edit');
// Rota para atualizar o fornecedor 
Route::put('/fornecedor/update/{fornecedor}', [FornecedorController::class, 'update'])->name('fornecedor.update');
// Rota para apagar o fornecedor 
Route::delete('/fornecedor/destroy/{fornecedor}', [FornecedorController::class, 'destroy'])->name('fornecedor.destroy');

Route::post('/fornecedor',[FornecedorController::class,'store'])->name('fornecedor.store');

/*-------------------------
CRUD ESTOQUE
--------------------------*/
//rota de estoque 
Route::get('/estoque',[EstoqueController::class,'index'])->name('estoque.index');

Route::get('/estoque/create',[EstoqueController::class,'create'])->name('estoque.create');

// Rota para abrir o formulario de editar
Route::get('/estoque/edit/{estoque}', [EstoqueController::class, 'edit'])->name('estoque.edit');
// Rota para atualizar o estoque 
Route::put('/estoque/update/{estoque}', [EstoqueController::class, 'update'])->name('estoque.update');
// Rota para apagar o estoque 
Route::delete('/estoque/destroy/{estoque}', [EstoqueController::class, 'destroy'])->name('estoque.destroy');

Route::post('/estoque',[EstoqueController::class,'store'])->name('estoque.store');

