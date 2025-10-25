<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group([
    'middleware' => 'api',
    'prefix' => 'api',
    'namespace' => 'App\Http\Controllers\Api',
], function () {
    Route::apiResource('suppliers', 'SupplierController');
    Route::apiResource('categories', 'CategoryController');
    Route::apiResource('products', 'ProductController');
    Route::post('/products/upload', 'ProductController@upload');
    Route::post('/products/import', 'ProductController@import');
    Route::get('/changes', 'HistoryController@index');
});
