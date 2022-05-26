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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*Route::group([
        'prefix'=>'',
        'middleware' => ['cors']
    ],
    function(){
        Route::resource('product','\App\Http\Controllers\ProductController');
    }
);*/

Route::resource('product','App\Http\Controllers\ProductController');
Route::resource('category','App\Http\Controllers\CategoryController');
Route::resource('client','App\Http\Controllers\ClientController');
Route::resource('service','App\Http\Controllers\ServiceController');
Route::resource('plan','App\Http\Controllers\PlanController');
Route::resource('receipt','App\Http\Controllers\ReceiptController');


Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', '\App\Http\Controllers\AuthController@login');
    Route::post('signup', '\App\Http\Controllers\AuthController@signUp');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', '\App\Http\Controllers\AuthController@logout');
        Route::get('user', '\App\Http\Controllers\AuthController@user');
        Route::post('user', '\App\Http\Controllers\AuthController@update');
    });
});

/*
Route::get('/articulos','App\Http\Controllers\ArticuloContorller@index');
Route::post('/articulos','App\Http\Controllers\ArticuloController@store');
Route::put('/articulos/{id}','App\Http\Controllers\ArticuloController@update');
Route::delete('/articulos/{id}','App\Http\Controllers\ArticuloController@destroy');
*/