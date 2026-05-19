<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\autorizacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PortariaController extends Controller
{
    public function store(Request $request)
    {
        // 1. Valida a requisição vinda do Svelte
        $validated = $request->validate([
            'AUT_alunoname' => 'required|string',
            'AUT_type'      => 'required|in:entrada,saida'
        ]);

        $nome = $validated['AUT_alunoname'];
        $tipo = $validated['AUT_type'];

        // 2. Se for saída, verifica se o professor pré-autorizou antes na lista de chamada
        if ($tipo === 'saida') {
            $possuiAutorizacao = autorizacao::where('AUT_alunoname', $nome)
                                            ->where('AUT_type', 'saida')
                                            ->exists();

            if (!$possuiAutorizacao) {
                return response()->json(['message' => 'Saída Bloqueada: Falta pré-autorização do professor.'], 403);
            }
        }

        // 3. DESAFIO: Simulação de disparos de Notificação Nativa do Laravel

        // A) Geração de Log::info (Simulando push de log / WhatsApp no terminal)
        Log::info("SAFE ALERTA: O aluno {$nome} realizou a {$tipo} na portaria do SENAI às " . now()->toDateTimeString());

        // B) Disparo de e-mail integrado ao Mailpit para simulação real
        // Caso queira criar uma Mailable class futuramente: php artisan make:mail AlertaPortaria
        Mail::raw("Olá, informamos que o aluno {$nome} acabou de registrar sua {$tipo} na portaria da instituição.", function ($message) use ($nome, $tipo) {
            $message->to('responsaveis@escola.com.br')
                    ->subject("SAFE: Notificação de Segurança - {$tipo} de {$nome}");
        });

        return response()->json([
            'status' => 'sucesso',
            'message' => "Movimentação de {$tipo} registrada. Notificações disparadas no Mailpit e Logs do sistema!"
        ], 200);
    }
}