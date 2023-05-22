<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
//Descomentar si se desea autenticar antes de eliminar un producto
//use App\Http\Middleware\ApiTokenIsValid;


Route::group(['prefix'=>'products'], function () {
    $idInThePath = '/{id}';
    Route::post('/', [ProductController::class, 'store'])->name('products-register');
    Route::post('/paginate', [ProductController::class, 'paginate']);
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::get($idInThePath, [ProductController::class, 'show']);
    Route::put($idInThePath, [ProductController::class, 'update'])->name('products-update');
    Route::delete($idInThePath, [ProductController::class, 'destroy']);

    //Descomentar si se desea autenticar antes de eliminar un producto
    //y autenticar con Bearer SkFabTZibXE1aE14ckpQUUxHc2dnQ2RzdlFRTTM2NFE2cGI4d3RQNjZmdEFITmdBQkE= en el header
    //Route::delete($idInThePath, [ProductController::class, 'destroy'])->middleware(ApiTokenIsValid::class);
});


