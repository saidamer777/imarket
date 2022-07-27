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

Route::group(['middleware'=>['api','checkpassword','auth.guard:wholesaler-api'],'namespace'=>'App\Http\Controllers\Api'],function (){

    Route::post('/categories','ApiMainCategoryController@getWholesalesMainCategories');
    Route::post('/products','ApiProductController@getWholesalesRandomData');
    Route::post('/ExtraProducts','ApiProductController@getWholesalesExtraProducts');


});


Route::group(['middleware'=>['api','checkpassword'],'namespace'=>'App\Http\Controllers\Api\Wholesaler'],function () {

    Route::post('login','WholesalerAuth@login');
    Route::post('/logout','WholesalerAuth@logout')->middleware('auth.guard:wholesaler-api');

    Route::group(['middleware'=>'auth.guard:wholesaler-api','prefix'=>'favourites'],function (){
        Route::post('/','ApiWholesalerFavourites@getList');
        Route::post('/add','ApiWholesalerFavourites@addproducttolist');
        Route::post('/delete','ApiWholesalerFavourites@deleteproductfromlist');




    });


});
Route::group(['middleware'=>['api','checkpassword','auth.guard:wholesaler-api'],'namespace'=>'App\Http\Controllers\Api\Wholesaler','prefix'=>'order'],function () {

    Route::post('/','ApiWholeSalerOrder@createorder');
    Route::post('/all','ApiWholeSalerOrder@getallorders');

});
