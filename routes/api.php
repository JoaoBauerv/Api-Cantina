<?php

use App\Http\Controllers\Api\CardapioController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\Api\MedidaController;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LoteController;
use App\Http\Controllers\Api\QuebraController;
use App\Http\Controllers\Api\ReceitaController;
use Illuminate\Support\Facades\Route;


//Login
Route::post('/', [LoginController::class, 'login'])->name('login'); // POST | {{base_url}} {"id_usuario": "1","senha": "123456"}

Route::group(['middleware'=>['auth:sanctum']], function(){ // baarer token {{token}}
    
    //Rotas de usuario
    Route::get('/users', [UserController::class, 'index']); // GET | {{base_url}}/users
    Route::get('/users/{user}', [UserController::class, 'show']);// GET | {{base_url}}/users/1
    Route::post('/users', [UserController::class, 'store']);// POST | {{base_url}}/users/1 | {"nm_usuario": "","senha": "","fl_permissao": }
    Route::put('/users/{user}', [UserController::class, 'update']);// PUT | {{base_url}}/users/1 | {"nm_usuario": "","senha": "","fl_permissao": }
    Route::delete('/users/{user}', [UserController::class, 'destroy']);// DELETE | {{base_url}}/users/1 

    //Rotas Medidas
    Route::get('/medidas', [MedidaController::class, 'index']); // GET | {{base_url}}/medidas
    Route::get('/medidas/{medida}', [MedidaController::class, 'show']);// GET | {{base_url}}/medidas/1
    Route::post('/medidas', [MedidaController::class, 'store']);// POST | {{base_url}}/medidas/1 | {"nm_medida": ""}
    Route::put('/medidas/{medida}', [MedidaController::class, 'update']);// PUT | {{base_url}}/medidas/1 | {"nm_medida": ""}
    Route::delete('/medidas/{medida}', [MedidaController::class, 'destroy']);// DELETE | {{base_url}}/medidas/1 

    //Rotas Produtos
    Route::get('/produtos', [ProdutoController::class, 'index']); // GET | {{base_url}}/produtos
    Route::get('/produtos/{produto}', [ProdutoController::class, 'show']);// GET | {{base_url}}/produtos/1
    Route::post('/produtos', [ProdutoController::class, 'store']);// POST | {{base_url}}/produtos/1 | {"nm_produto": "","id_medida": ""}
    Route::put('/produtos/{produto}', [ProdutoController::class, 'update']);// PUT | {{base_url}}/produtos/1 | {"nm_medida": "", "id_medida": ""}
    Route::delete('/produtos/{produto}', [ProdutoController::class, 'destroy']);// DELETE | {{base_url}}/produtos/1 

    //Rotas Lotes
    Route::get('/lotes', [LoteController::class, 'index']); // GET | {{base_url}}/lotes
    Route::get('/lotes/{lote}', [LoteController::class, 'show']); // GET | {{base_url}}/lotes/1
    Route::post('/lotes', [LoteController::class, 'store']); // POST | {{base_url}}/lotes | {"dt_entrada": "2025-09-11","id_usuario": 1,"produtos": [{"id_produto": 3,"qt_entrada": 50,"qt_atual_lote": 50}]}


    //Rotas Quebras
    Route::get('/quebras', [QuebraController::class, 'index']); // GET | {{base_url}}/quebras
    Route::get('/quebras/{quebra}', [QuebraController::class, 'show']);// GET | {{base_url}}/quebras/1
    Route::post('/quebras', [QuebraController::class, 'store']);// POST | {{base_url}}/quebras | {"id_produto": "3","qt_quebra": "30","id_usuario": "1"}

    //Rotas Receitas
    Route::get('/receitas', [ReceitaController::class, 'index']); // GET | {{base_url}}/receitas
    Route::get('/receitas/{receita}', [ReceitaController::class, 'show']); // GET | {{base_url}}/receitas/1
    Route::post('/receitas', [ReceitaController::class, 'store']);// GET | {{base_url}}/receitas | 

    //Rotas Cardapios
    Route::get('/cardapios', [CardapioController::class, 'index']); // GET | {{base_url}}/cardapios
    Route::get('/cardapios/{cardapio}', [CardapioController::class, 'show']); // GET | {{base_url}}/cardapios/1
    Route::post('/cardapios', [CardapioController::class, 'store']); // POST | {{base_url}}/cardapios

    //Logout
    Route::post('/logout/{user}', [LoginController::class, 'logout']); // POST | {{base_url}}/logout/1

});