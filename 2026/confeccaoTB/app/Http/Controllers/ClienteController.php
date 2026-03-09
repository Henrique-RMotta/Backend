<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
class ClienteController extends Controller
{
    public function index() {
        $clientes = Clientes::all();// busca todos os clientes
        return view('clientes.index',compact('clientes'));
    }

    // Exibe o formulário de cadastro (a janela/página de inserção)
    public function create () {
        return view('clientes.create');
    }

    // Recebe os dados do formulário e salva no banco de dados
    public function store (Request $request) {

    // 1. Validação simples para evitar dados vazios ou duplicados
        $request->validate([
            'name' => 'required|string|max:255',
            'cpf'  =>  'required|string|unique:clientes',
            'email' => 'required|email|unique:clientes',
            'telefone' => 'required|string', 
        ]);

        //2. Salva o novo cliente 
        Clientes::create($request->all());

        //3. Redireciona de volta para a lista com uma mensagem de sucesso 
        return redirect()->route('clientes.index')->with('sucess','Cliente cadastrado com sucesso !');
    }
}
