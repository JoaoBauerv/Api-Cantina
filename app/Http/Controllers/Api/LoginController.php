<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request) : JsonResponse
    {
        
        // Buscar o usuário manualmente
        $user = User::where('id_usuario', $request->id_usuario)->first();

        // Verificar se usuário existe e senha está correta
        if ($user && Hash::check($request->senha, $user->senha)) {
            

            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'status' => true,
                'token' => $token,
                'message' => 'Login realizado com sucesso',
                'user' => [
                    'id_usuario' => $user->id_usuario, // Usar o campo correto
                    'nm_usuario' => $user->nm_usuario,
                    'fl_permissao' => $user->fl_permissao ?? null,
                ],
            ], 200);

        
        }else{

            return response()->json([
                'status'=> false,
                'message'=> 'Login ou senha incorreta',
            ], 404);
        }
    }

    public function logout(User $user) : JsonResponse
    {   
        try {
    
            $user->tokens()->delete();
            
            return response()->json([
                'status'=> true,
                'message'=> 'Deslogado com sucesso',
            ], 200);
        
        } catch (Exception $e) {
            
            return response()->json([
                'status'=> false,
                'message'=> 'Não deslogado',
            ], 404);
        
        }
    }
}
