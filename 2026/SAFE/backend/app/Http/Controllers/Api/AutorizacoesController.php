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
        $autorizacoes = autorizacao::with('portaria')->orderBy('created_at', 'desc')->get();
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
            "AUT_signature_image" => "required|string",
            "AUT_teacher_email"  => "required|email|max:255",
            "AUT_fouls"          => "nullable",
            "AUT_time"           => "required",
            "AUT_nameaqv"        => "nullable|string"
        ]);

        try {
            // Garantir que campos extras do front sejam salvos
            $validated['AUT_signature_name'] = $request->AUT_nameaqv ?? 'AQV';
            
            // CONVERSÃO: Transformar o array de faltas em string JSON para o banco
            if (isset($validated['AUT_fouls'])) {
                $validated['AUT_fouls'] = json_encode($validated['AUT_fouls']);
            }

            // FORMATAÇÃO: Garantir que a data do Svelte seja aceita pelo MySQL
            if (isset($validated['AUT_time'])) {
                $validated['AUT_time'] = date('Y-m-d H:i:s', strtotime($validated['AUT_time']));
            }
            
            $aut = autorizacao::create($validated);
            
            // Cria o registro na portaria vinculado a esta autorização
            \App\Models\portaria::create(['AUT_ID' => $aut->id]);

            return response()->json(['mensagem' => 'Autorização criada'], 201);
        } catch (QueryException $err) {
            return response()->json(['erro' => 'Erro na criação: ' . $err->getMessage()], 500);
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
