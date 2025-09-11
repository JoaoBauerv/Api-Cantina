<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedidaRequest;
use App\Models\Medida;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedidaController extends Controller
{
    public function index() : JsonResponse
    {
            
        $medidas = Medida::orderBy('id_medida', 'DESC')->get();

        return response()->json([
        'status' => true,
        'medidas' => $medidas,
        ], 200);
    }

    public function show(Medida $medida) : JsonResponse
    {
        return response()->json([
        'status' => true,
        'medida' => $medida,
        ], 200);
    }

    
    public function store(MedidaRequest $request)
    {
        DB::beginTransaction();

        try{

            $medida = Medida::create([
                'nm_medida'=>$request->nm_medida,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'medida' => $medida,
                'message' => "Medida cadastrada com sucesso!",
            ], 201);

        }catch(Exception $e){
            
            DB::rollBack();
            
            return response()->json([
                'status' => false,
                'message' => "Medida não cadastrada!",
                'medida' =>$request,
            ], 400);

        }
    }

    public function update(MedidaRequest $request, Medida $medida) : JsonResponse
    {
        DB::beginTransaction();

        try {

            $medida->update([
                'nm_medida' => $request->nm_medida,
                ]);

            DB::commit();


            return response()->json([
                'status' => true,
                'message' => "Medida editada!",
                'medida' =>$medida,
            ], 200);


        } catch (Exception $e) {
            
            DB::rollBack();
            
            return response()->json([
                'status' => false,
                'message' => "Medida não editada!",
                'medida' =>$request,
            ], 400);

        }
         
    }

    public function destroy(Medida $medida) : JsonResponse
    {
        try {

            $medida->delete();

            return response()->json([
                'status' => true,
                'medida' =>$medida,
                'message' => "Medida apagada!",
            ], 200);
    
            
        } catch (Exception $e) {

            
            return response()->json([
                'status' => false,
                'message' => "Medida não apagada!",
            ], 400);

            
        }
    }

}
