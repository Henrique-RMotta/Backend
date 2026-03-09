<?php

namespace App\Http\Controllers;
use App\Models\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function index() {
        $estoque = Estoque::all();
        return view("estoque.index",compact("estoque"));
    }

    public function create () {
        return view("estoque.create");
    }

    public function store(Request $request) {
        $request -> validate ([
            "ES_nome" => "string|max:100|unique:estoque",
            "ES_quantidade" => "numeric|max:999",
        ]);

        Estoque::create($request->all());

        return redirect()->route("estoque.index")->with("sucess","Item adicionado com sucesso");
    }
}
