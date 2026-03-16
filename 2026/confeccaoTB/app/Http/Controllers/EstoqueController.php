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

        return redirect()->route("estoque.index")->with("success","Item adicionado com sucesso");
    }

    public function edit(Estoque $estoque) {
        return view('estoque.edit',compact('estoque'));
    }

    public function update(Request $request, Estoque $estoque) {
        $request -> validate ([
            "ES_nome" => "string|max:100|unique:estoque,ES_nome," . $estoque->id ,
            "ES_quantidade" => "numeric|max:999",
        ]);

        $estoque->update($request->all());

        return redirect()->route("estoque.index")->with("success","Item atualizado com sucesso");
    }

     public function destroy(Estoque $estoque) {
        $estoque->delete();
        return redirect()->route('estoque.index')->with('success', 'item deletado com sucesso');
    }
}
