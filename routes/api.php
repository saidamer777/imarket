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

Route::group(['middleware'=>['api','checkpassword'],'namespace'=>'App\Http\Controllers\Api'],function () {

    ///// products routes
    Route::post('/products','ApiProductController@getRandomData');
    Route::post('/ExtraProducts','ApiProductController@getExtraProducts');


    ///maincategories routes
    Route::post('/categories','ApiMainCategoryController@getMainCategories');



});


