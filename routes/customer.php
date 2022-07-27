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

Route::group(['middleware'=>['api','checkpassword'],'namespace'=>'App\Http\Controllers\Api\Customer'],function () {

    ////// login Route
    Route::post('/register','CustomerAuth@register');
    Route::post('/logout','CustomerAuth@logout')->middleware('has_api');
    Route::post('/delete','CustomerAuth@delete_account')->middleware('has_api');
    Route::post('/edit_with_phone','CustomerAuth@editaccountwithnumber')->middleware('has_api');
    Route::post('/edit_without_phone','CustomerAuth@editaccountwithoutnumber')->middleware('has_api');

    Route::group(['middleware'=>['has_api'],'prefix'=>'favourites'],function (){


        /////////// get favourite list for spicific customer
        Route::post('/','ApiCustomerFavourites@getList');
        Route::post('/add','ApiCustomerFavourites@addproducttolist');
        Route::post('/delete','ApiCustomerFavourites@deleteproductfromlist');


    });

    Route::group(['middleware'=>['has_api'],'prefix'=>'order'],function () {
        Route::post('/','ApiCustomerOrder@createorder');
        Route::post('/all','ApiCustomerOrder@getallorders');


    });


    });
