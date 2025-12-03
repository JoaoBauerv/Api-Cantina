<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProdutoReceita;
use App\Models\Receita;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceitaController extends Controller
{
    
    public function index() : JsonResponse
    {
            
        $receitas = Receita::with('produtosReceita.produto:id_produto,nm_produto')
                            ->orderBy('id_receita', 'DESC')
                            ->get();

        return response()->json([
        'status' => true,
        'receitas' => $receitas,
        ], 200);
    }

    public function show(Receita $receita) : JsonResponse 
    {
        $receita->load(['produtosReceita']);

        return response()->json([
        'status' => true,
        'receita' => $receita,
        ], 200);
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $receita = Receita::create([
                'nm_receita' => $request->nm_receita,
                'id_medida' => $request->id_medida,
            ]);

            foreach ($request->produtos as $produto) {
                ProdutoReceita::create([
                    'id_receita'    => $receita->id_receita,
                    'id_produto'    => $produto['id_produto'],
                    'qt_usada'      => $produto['qt_usada'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Lote e produtos inseridos com sucesso',
                'receita'    => $receita
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
