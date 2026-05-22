<?php

namespace App\Http\Controllers;

use App\Models\Autorizacao;
use App\Models\Portaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AutorizacaoController extends Controller
{
    public function index()
    {
        return Autorizacao::with('portaria')->orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $autorizacao = new Autorizacao();
        $autorizacao->AUT_alunoname = $request->AUT_alunoname;
        $autorizacao->AUT_alunoclass = $request->AUT_alunoclass;
        $autorizacao->AUT_type = $request->AUT_type;
        $autorizacao->AUT_nameaqv = $request->AUT_nameaqv;
        $autorizacao->AUT_signature_image = $request->AUT_signature_image ?? 'assinatura_vazia';
        $autorizacao->AUT_time = now();
        $autorizacao->save();

        Portaria::create(['AUT_ID' => $autorizacao->id]);

        return response()->json($autorizacao, 201);
    }

    public function validar($id)
    {
        $portaria = Portaria::where('AUT_ID', $id)->first();
        if ($portaria) {
            $portaria->update(['PORT_validate' => true]);
            
            $aut = Autorizacao::find($id);
            Log::info("NOTIFICAÇÃO SAFE: Aluno {$aut->AUT_alunoname} realizou {$aut->AUT_type} em " . now());
            
            return response()->json(['message' => 'Validado com sucesso']);
        }
        return response()->json(['message' => 'Erro ao validar'], 404);
    }
}
