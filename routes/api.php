<?php

use App\Http\Controllers\Api\catserviciosController;
use App\Http\Controllers\Api\ClientesOdontologosController;
use App\Http\Controllers\API\ClinicaController;
use App\Http\Controllers\Api\detalle_ordenesController;
use App\Http\Controllers\Api\itemservicesController;
use App\Http\Controllers\Api\OdontologosController;
use App\Http\Controllers\Api\OrdenesController;
use App\Http\Controllers\Api\OrdenVirtualController;
use App\Http\Controllers\Api\PacientesController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\userController;

Route::post('/register', [userController::class, 'register']);
Route::post('/login', [userController::class, 'login']);

Route::group(['middleware' => ["auth:sanctum"]], function () {
    //RUTAS
    Route::get('user-profile', [userController::class, 'userProfile']);
    Route::post('logout', [userController::class, 'logout']);
    
    //GRUPO CONTROLADOR
    Route::controller(ClinicaController::class)->group(function(){
        Route::get('/allClinicas','index');
        Route::post('/saveClinica','store2');
        Route::get('/oneClinica/{id}','show');
        Route::put('/updateClinica/{id}','update');
        Route::delete('/deleteClinica/{id}','destroy');
    });

    Route::controller(PacientesController::class)->group(function(){
        Route::get('/allPacientes','index');
        Route::post('/savePaciente','store');
        Route::get('/onePaciente/{id}','show');
        Route::put('/updatePaciente/{id}','update');
        Route::post('/validarPaciente','eyes');
        Route::delete('/deletePaciente/{id}','destroy');
    });

    Route::controller(OdontologosController::class)->group(function(){
        Route::get('/allOdontologos','index');
        Route::post('/saveOdontologo','store');
        Route::get('/oneOdontologo/{id}','show');
        Route::put('/updateOdontologo/{id}','update');
        Route::delete('/deleteOdontologo/{id}','destroy');
    });

    Route::controller(catserviciosController::class)->group(function(){
        Route::get('/allServicios','index');
        Route::post('/saveServicio','store');
        Route::get('/oneServicio/{id}','show');
        Route::put('/updateServicio/{id}','update');
        Route::delete('/deleteServicio/{id}','destroy');
    });

    Route::controller(itemservicesController::class)->group(function(){
        Route::get('/allItemServices','index');
        Route::post('/saveItem','store');
        Route::get('/oneItem/{id}','show');
        Route::put('/updateItem/{id}','update');
        Route::delete('/deleteItem/{id}','destroy');
    });

    Route::controller(detalle_ordenesController::class)->group(function(){
        Route::get('/allDetallesOrdenes','index');
        Route::post('/saveDetalleOrden','store');
        // Route::get('/oneItem/{id}','show');
        // Route::put('/updateItem/{id}','update');
        // Route::delete('/deleteItem/{id}','destroy');
    });

    Route::controller(OrdenesController::class)->group(function(){
        Route::get('/allOrdenVirtuales','index');
        Route::post('/saveOrdenVirtual','store');
        Route::get('/oneOrdenVirtual/{id}','show');
        Route::put('/updateOrdenVirtual/{id}','update');
        // Route::delete('/deleteOdontologo/{id}','destroy');
    });
    
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// CONTROLADOR DE PRODUCTOS - EJEMPLO GENERAL
// Route::controller(ProductController::class)->group(function(){
//     Route::get('/allProducto','index');
//     Route::post('/saveProducto','store');
//     Route::get('/oneProducto/{id}','show');
//     Route::put('/updateProducto/{id}','update');
//     Route::delete('/deleteProducto/{id}','destroy');
// });