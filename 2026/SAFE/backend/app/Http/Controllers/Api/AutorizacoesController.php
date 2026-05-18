<?php

namespace App\Http\Controllers\Api;

use App\Models\autorizacao;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;

class AutorizacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $autorizacoes = autorizacao::all();
        return response()->json($autorizacoes);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $validated = $request->validate([
            "AUT_alunoname"      => "required|string|max:255",
            "AUT_alunoclass"     => "required|string|max:255",
            "AUT_type"           => "required|in:entrada,saida",
            "AUT_signature_name" => "required|string|max:255",
            "AUT_signature_image" => "required|string",
            "AUT_teacher_email"  => "required|email|max:255",
            "AUT_fouls"          => "nullable|array",
            "AUT_time"           => "required|date",
        ]);

        try {
            autorizacao::create($validated);
            return response()->json(['mensagem' => 'Autorização criada'], 201);
        } catch (QueryException $err) {
            return response()->json(['erro' => 'Erro na criação'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
