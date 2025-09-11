<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quebra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuebraController extends Controller
{
    public function index() : JsonResponse
    {
            
        $quebras = Quebra::orderBy('id_quebra', 'DESC')->get();

        return response()->json([
        'status' => true,
        'quebras' => $quebras,
        ], 200);
    }

    public function show(Quebra $quebra) : JsonResponse 
    {
        return response()->json([
        'status' => true,
        'quebra' => $quebra,
        ], 200);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $quebra = Quebra::create([
                'id_produto' => $request->id_produto,
                'qt_quebra' => $request->qt_quebra,
                'id_usuario' => $request->id_usuario,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Quebra inserida com sucesso',
                'quebra'    => $quebra
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
