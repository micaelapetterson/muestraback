<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Rutas Test

Route::group(['middleware' => ['api']], function () {

    // http://127.0.0.1:8000/api/persona
    Route::get("/persona", function(){
        return ["nombre"=>"Nombre de Prueba MilanetBack", "edad"=>40];
    });

});

// Rutas Auth

Route::prefix('/v1/auth')->group(function (){

    Route::post('/login', [AuthController::class, "funLogin"]);
    Route::post('/register', [AuthController::class, "funRegistro"]);

    Route::middleware('auth:sanctum')->group(function(){
        Route::get('/perfil', [AuthController::class, "funPerfil"]);
        Route::post('/logout', [AuthController::class, "funSalir"]);
    });   

});

Route::middleware('auth:sanctum')->group(function(){

    Route::post("producto/{id}/actualizar-imagen",[ProductoController::class, "actualizarImagen"]);

    Route::apiResource("usuario", UsuarioController::class);
    Route::apiResource("producto", ProductoController::class);

});


Route::apiResource("categoria", CategoriaController::class);


Route::get("no-autorizado", function(){
    return ["message" => "No tienes permiso"];
})->name("login");

















/*

// rutas auth
Route::prefix('/v1/auth')->group(function (){

    Route::post('/login', [AuthController::class, "funLogin"]);
    Route::post('/register', [AuthController::class, "funRegistro"]);

    Route::middleware('auth:sanctum')->group(function(){
        Route::get('/perfil', [AuthController::class, "funPerfil"]);
        Route::post('/logout', [AuthController::class, "funSalir"]);
    });   

});

Route::middleware('auth:sanctum')->group(function(){

    Route::post("producto/{id}/actualizar-imagen",[ProductoController::class, "actualizarImagen"]);

    Route::apiResource("categoria", CategoriaController::class);
    Route::apiResource("usuario", UsuarioController::class);
    Route::apiResource("producto", ProductoController::class);
    Route::apiResource("cliente", ClienteController::class);
    Route::apiResource("pedido", PedidoController::class);

});

Route::get("no-autorizado", function(){
    return ["message" => "No tienes permiso"];
})->name("login");

*/