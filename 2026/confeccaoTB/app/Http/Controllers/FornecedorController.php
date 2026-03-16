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

        return redirect()->route("fornecedor.index")->with("success", "Fornecedor criado com sucesso");
    }

    public function edit(Fonecedor $fornecedor) {
        return view('fornecedor.edit',compact('fornecedor'));
    }

    public function update(Request $request, Fornecedor $fornecedor) {
        $request ->validate([
            "FOR_nome" => 'string|max:100|unique:fornecedor,FOR_nome,' . $fornecedor->id,
            "FOR_cpf" => 'string|max:14|unique:fornecedor,FOR_cpf,' . $fornecedor->id,
            "FOR_telefone" => 'numeric|unique:fornecedor,FOR_telefone,' . $fornecedor->id,
            "FOR_endereco" => 'string|max:255|unique:fornecedor,FOR_endereco,' . $fornecedor->id,
        ]);

        $fornecedor->update($request->all());
        return redirect()->route('fornecedor.index')->with('success','Fornecedor atualizado com sucesso');
    }
    public function destroy(Fornecedor $fornecedor) {
        $fornecedor->delete();
        return redirect()->route('fornecedor.index')->with('success', 'Fornecedor deletado com sucesso');
    }
}
