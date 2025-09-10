<?php

use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


//login
Route::post('/', [LoginController::class, 'login'])->name('login'); // POST | {{base_url}} {"id_usuario": "1","senha": "123456"}

Route::group(['middleware'=>['auth:sanctum']], function(){ // baarer token {{token}}
    
    //Rotas de usuario
    Route::get('/users', [UserController::class, 'index']); // GET | {{base_url}}/users
    Route::get('/users/{user}', [UserController::class, 'show']);// GET | {{base_url}}/users/1
    Route::post('/users', [UserController::class, 'store']);// POST | {{base_url}}/users/1 | {"nm_usuario": "","senha": "","fl_permissao": }
    Route::put('/users/{user}', [UserController::class, 'update']);// PUT | {{base_url}}/users/1 | {"nm_usuario": "","senha": "","fl_permissao": }
    Route::delete('/users/{user}', [UserController::class, 'destroy']);// DELETE | {{base_url}}/users/1 

    //


    //


    //


    //Logout
    Route::post('/logout/{user}', [LoginController::class, 'logout']); // POST | {{base_url}}/logout/1

});