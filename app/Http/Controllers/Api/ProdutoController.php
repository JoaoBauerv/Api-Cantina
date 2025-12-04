<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    public function index() : JsonResponse
    {
            
        $produtos = Produto::orderBy('nm_produto', 'ASC')->get();

        return response()->json([
        'status' => true,
        'produtos' => $produtos,
        ], 200);
    }

    public function show(Produto $produto) : JsonResponse 
    {
        return response()->json([
        'status' => true,
        'produto' => $produto,
        ], 200);
    }

    public function topMenorEstoque() : JsonResponse
    {
        $produtos = Produto::orderBy('qt_estoque', 'ASC')
                        ->take(5)
                        ->get();

        return response()->json([
            'status' => true,
            'produtos' => $produtos,
        ], 200);
    }
    
    public function store(ProdutoRequest $request)
    {
        DB::beginTransaction();
        try{

            $produto = Produto::create([
                'nm_produto' => $request->nm_produto,
                'id_medida'=>$request->id_medida,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'produto' => $produto,
                'message' => "Produto cadastrado com sucesso!",
            ], 201);

        }catch(Exception $e){
            
            DB::rollBack();
            
            return response()->json([
                'status' => false,
                'message' => "Produto não cadastrado! Erro: " . $e->getMessage(),
                'produto' =>$request,
            ], 400);

        }
    }

    public function update(ProdutoRequest $request, Produto $produto) : JsonResponse
    {
        DB::beginTransaction();

        try {

            $produto->update([
                'nm_produto' => $request->nm_produto,
                'id_medida' => $request->id_medida,
            ]);

            DB::commit();


            return response()->json([
                'status' => true,
                'message' => "Produto editado!",
                'produto' =>$produto,
            ], 200);


        } catch (Exception $e) {
            
            DB::rollBack();
            
            return response()->json([
                'status' => false,
                'message' => "Produto não editado! Erro: " . $e->getMessage(),
                'produto' =>$request,
            ], 400);

        }
         
    }

    public function destroy(Produto $produto) : JsonResponse
    {
        try {

            $produto->delete();

            return response()->json([
                'status' => true,
                'produto' =>$produto,
                'message' => "Produto apagado!",
            ], 200);
    
            
        } catch (Exception $e) {

            
            return response()->json([
                'status' => false,
                'message' => "Produto não apagado! Erro: " . $e->getMessage(),
            ], 400);

            
        }
    }
}
