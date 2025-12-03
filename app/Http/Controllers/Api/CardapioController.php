<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cardapio;
use App\Models\CardapioReceita;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardapioController extends Controller
{
    public function index() : JsonResponse
    {
            
        $cardapios = Cardapio::with('cardapioReceitas.receita:id_receita,nm_receita') 
                ->orderBy('id_cardapio', 'DESC')
                ->get();

        return response()->json([
        'status' => true,
        'cardapios' => $cardapios,
        ], 200);
    }

    public function show(Cardapio $cardapio) : JsonResponse 
    {
        $cardapio->load(['cardapioReceitas']);

        return response()->json([
        'status' => true,
        'cardapio' => $cardapio,
        ], 200);
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $cardapio = Cardapio::create([
                'dt_cardapio' => $request->dt_cardapio,
                
            ]);

            foreach ($request->receitas as $receita) {
                CardapioReceita::create([
                    'id_cardapio'       => $cardapio->id_cardapio,
                    'id_receita'    => $receita['id_receita'],
                    'qt_produzida'    => $receita['qt_produzida'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Cardapio e receitas inseridos com sucesso',
                'cardapio'    => $cardapio
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
