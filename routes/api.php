<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('products', 'ProductController@index');
Route::get('products/{product}', 'ProductController@show');
Route::post('products', 'ProductController@create');
Route::put('products/{product}', 'ProductController@update');
Route::delete('products/{product}', 'ProductController@delete');