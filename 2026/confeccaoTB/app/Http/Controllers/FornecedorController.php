<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
class FornecedorController extends Controller
{
    public function index(){
        $fornecedores = Fornecedor::all();
        return view("fornecedor.index", compact("fornecedores"));
    }

    public function create() {
        return view("fornecedor.create");
    }

    public function store(Request $request) {
        $request ->validate([
            "FOR_nome" => 'string|unique:fornecedor|max:100',
            "FOR_cpf" => 'string|unique:fornecedor|max:14',
            "FOR_telefone" => 'numeric|unique:fornecedor',
            "FOR_endereco" => 'string|unique:fornecedor|max:255',
        ]);

        Fornecedor::create($request->all());

        return redirect()->route("fornecedor.index")->with("sucess", "Fornecedor criado com sucesso");
    }
}
