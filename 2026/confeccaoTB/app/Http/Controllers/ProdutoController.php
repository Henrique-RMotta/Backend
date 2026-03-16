<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
class ProdutoController extends Controller
{
    public function index() {
    $produto = Produto::all();
    return view("produto.index", compact("produto"));
    }

    public function create() {
        return view("produto.create");
    }
    
    public function store(Request $request) {
        $request ->validate([
            "PR_nome" => 'required|string|unique:produtos|max:100',
            "PR_descricao" => 'required|string|max:255',
            "PR_preco" => 'required|numeric',
        ]);

        Produto::create($request->all());

        return redirect()->route("produto.index")->with("success","produto criado com sucesso");
    }

    public function edit(Produto $produto) {
        return view("produto.edit",compact('produto'));
    }

    public function update(Request $request, Produto $produto) {
        $request ->validate([
            "PR_nome" => 'required|string|max:100|unique:produtos,PR_nome,' . $produto->id,
            "PR_descricao" => 'required|string|max:255',
            "PR_preco" => 'required|numeric',
        ]);

        $produto->update($request->all());

        return redirect()->route("produto.index")->with("success","produto atualizado com sucesso");
    }

    public function destroy(Produto $produto) {
        $produto->delete();
        return redirect()->route("produto.index")->with("success","produto deletado com sucesso");
    }
}
