<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function index() {
        $pedidos = Pedido::all(); 
        return view("pedido.index",compact("pedidos"));
    }

    public function create() {
        return view("pedido.create");
    }

    public function store(Request $request) {
        $request ->validate([
            "nome" => 'required|string|max:100',
            "produto" => 'required|string|max:100|unique:pedidos',
            "fornecedor" => 'required|string|max:100'
        ]);
        
        Pedido::create($request->all());

        return redirect()->route('pedido.index')->with('sucess','Pedido cadastrado com sucesso');
    }
}
