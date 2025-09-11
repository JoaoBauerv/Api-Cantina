<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lote;
use App\Models\ProdutoLote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoteController extends Controller
{
    public function index() : JsonResponse
    {
            
        $lotes = Lote::with('produtosLote') 
                ->orderBy('id_lote', 'DESC')
                ->get();

        return response()->json([
        'status' => true,
        'lotes' => $lotes,
        ], 200);
    }

    public function show(Lote $lote) : JsonResponse 
    {
        $lote->load(['produtosLote']);

        return response()->json([
        'status' => true,
        'lote' => $lote,
        ], 200);
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $lote = Lote::create([
                'dt_entrada' => $request->dt_entrada,
                'id_usuario' => $request->id_usuario,
            ]);

            foreach ($request->produtos as $produto) {
                ProdutoLote::create([
                    'id_lote'       => $lote->id_lote,
                    'id_produto'    => $produto['id_produto'],
                    'qt_entrada'    => $produto['qt_entrada'],
                    'qt_atual_lote' => $produto['qt_atual_lote'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Lote e produtos inseridos com sucesso',
                'lote'    => $lote
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