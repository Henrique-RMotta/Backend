<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
class ProdutoController extends Controller
{
    public function index() {
    $produtos = Produto::all();
    return view("produto.index", compact("produtos"));
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

        return redirect()->route("produto.index")->with("sucess","produto criado com sucesso");
    }
}
