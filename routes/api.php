<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group([
    'middleware' => 'auth:api',
    'namespace' => 'App\Http\Controllers\Api',
], function () {
    Route::apiResource('suppliers', 'SupplierController');
    Route::apiResource('categories', 'CategoryController');
    Route::post('/products/upload', 'ProductController@upload');
    Route::post('/products/import', 'ProductController@import');
    Route::apiResource('products', 'ProductController');
    Route::get('/changes', 'HistoryController@index');
});
