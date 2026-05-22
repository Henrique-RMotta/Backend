<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        // Retornamos o usuário e o papel diretamente para simplificar
        return response()->json([
            'user' => $user,
            'token' => 'token-simples-safe' // Simulação simples de token
        ]);
    }
}
