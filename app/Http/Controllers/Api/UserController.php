<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() : JsonResponse
    {
            
        $users = User::orderBy('id_usuario', 'DESC')->get();

        return response()->json([
        'status' => true,
        'users' => $users,
        ], 200);
    }

    public function show(User $user) : JsonResponse 
    {
        return response()->json([
        'status' => true,
        'user' => $user,
        ], 200);
    }

    public function store(UserRequest $request)
    {
        DB::beginTransaction();

        try{

            $user = User::create([
                'nm_usuario' => $request->nm_usuario,
                'senha' => Hash::make($request->senha, ['rounds'=>12]),
                'fl_permissao' => $request->fl_permissao,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => "Usuário cadastrado com sucesso!",
            ], 201);

        }catch(Exception $e){
            
            DB::rollBack();
            
            return response()->json([
                'status' => false,
                'message' => "Usuário não cadastrado!",
                'user' =>$request,
            ], 400);

        }
    }

    public function update(UserRequest $request, User $user) : JsonResponse
    {
        DB::beginTransaction();

        try {

            $user->update([
                'nm_usuario' => $request->nm_usuario,
                'senha' => Hash::make($request->senha, ['rounds'=>12]),
                'fl_permissao' => $request->fl_permissao,
            ]);

            DB::commit();


            return response()->json([
                'status' => true,
                'message' => "Usuário editado!",
                'user' =>$user,
            ], 200);


        } catch (Exception $e) {
            
            DB::rollBack();
            
            return response()->json([
                'status' => false,
                'message' => "Usuário não editado!",
                'user' =>$request,
            ], 400);

        }
         
    }

    public function destroy(User $user) : JsonResponse
    {
        try {

            $user->delete();

            return response()->json([
                'status' => true,
                'user' =>$user,
                'message' => "Usuário apgado!",
            ], 200);
    
            
        } catch (Exception $e) {

            
            return response()->json([
                'status' => false,
                'message' => "Usuário não apagado!",
            ], 400);

            
        }
    }
}
