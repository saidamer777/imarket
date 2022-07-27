<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'Auth:admin'], function () {

    Route::get('/', 'DashboardController@index')->name('admin.dashboard');

    ####################### Begin Languages Routes #######################

    Route::group(['prefix' => 'languages'], function () {
        Route::get('/', 'LanguagesController@getLanguages')->name('admin.languages');
        Route::get('create', 'LanguagesController@create')->name('admin.languages.create');
        Route::post('store', 'LanguagesController@store')->name('admin.languages.store');
        Route::get('edit/{id}', 'LanguagesController@edit')->name('admin.languages.edit');
        Route::post('update/{id}', 'LanguagesController@update')->name('admin.languages.update');
        Route::get('delete/{id}', 'LanguagesController@delete')->name('admin.languages.delete');
    });
    ######################## End Languages Routes  ########################


    ####################### Begin MainCategories Routes #######################

    Route::group(['prefix' => 'main_categories'], function () {
        Route::get('/', 'MainCategoriesController@getcategories')->name('admin.maincategories');
        Route::get('create', 'MainCategoriesController@create')->name('admin.maincategories.create');
        Route::post('store', 'MainCategoriesController@store')->name('admin.maincategories.store');
        Route::get('edit/{id}', 'MainCategoriesController@edit')->name('admin.maincategories.edit');
        Route::post('update/{id}', 'MainCategoriesController@update')->name('admin.maincategories.update');
        Route::get('delete/{id}', 'MainCategoriesController@delete')->name('admin.maincategories.delete');

        ######################## End MainCategories Routes  ########################

    });


    ######################## Extra MainCategories Route  ########################
    Route::get('extra_main_categories', 'MainCategoriesController@getextra')->name('admin.maincategories.extra');
    ######################## Extra MainCategories Route  ########################


    ####################### Begin products Routes #######################

    Route::group(['prefix' => 'products'], function () {
        Route::get('/{id}', 'ProductController@getproductsData')->name('admin.products');
        Route::get('create/{id}', 'ProductController@create')->name('admin.products.create');
        Route::post('store/{cat_id}', 'ProductController@store')->name('admin.products.store');
        Route::get('edit/{id}', 'ProductController@edit')->name('admin.products.edit');
        Route::post('update/{id}', 'ProductController@update')->name('admin.products.update');
        Route::get('delete/{id}', 'ProductController@delete')->name('admin.products.delete');

        ######################## End products Routes  ########################

    });

    ######################## Extra MainCategories Route  ########################
    Route::get('extra_products', 'ProductController@getextra')->name('admin.products.extra');
    ######################## Extra MainCategories Route  ########################

    ####################### Begin products images Routes ????????????
    Route::group(['prefix' => 'products_images'], function () {
        Route::get('/{id}', 'ProductController@show_product_images')->name('admin.products_images');
        Route::get('create/{id}', 'ProductController@add_image')->name('admin.products.addimage');
        Route::post('store/{cat_id}', 'ProductController@store_image')->name('admin.products.store_image');
        Route::get('edit/{id}', 'ProductController@edit_image')->name('admin.products.edit_image');
        Route::post('update/{id}', 'ProductController@update_image')->name('admin.products.update_image');
        Route::get('delete/{id}', 'ProductController@delete_image')->name('admin.products.delete_image');

        ######################## End products images Routes  ########################

    });


    ####################### Begin wholesales products images Routes ????????????
    Route::group(['prefix' => 'wholesales_products_images'], function () {
        Route::get('/{id}', 'WholeSalesProductsController@show_product_images')->name('admin.wholesales_products_images');
        Route::get('create/{id}', 'WholeSalesProductsController@add_image')->name('admin.wholesales_products.addimage');
        Route::post('store/{cat_id}', 'WholeSalesProductsController@store_image')->name('admin.wholesales_products.store_image');
        Route::get('edit/{id}', 'WholeSalesProductsController@edit_image')->name('admin.wholesales_products.edit_image');
        Route::post('update/{id}', 'WholeSalesProductsController@update_image')->name('admin.wholesales_products.update_image');
        Route::get('delete/{id}', 'WholeSalesProductsController@delete_image')->name('admin.wholesales_products.delete_image');

        ######################## End products images Routes  ########################

    });


    ####################### Begin wholesalesproducts Routes #######################


    Route::group(['prefix' => 'wholesales'], function () {
        Route::get('/{id}', 'WholeSalesProductsController@getproductsData')->name('admin.wholesales');
        Route::get('create/{id}', 'WholeSalesProductsController@create')->name('admin.wholesales.create');
        Route::post('store/{cat_id}', 'WholeSalesProductsController@store')->name('admin.wholesales.store');
        Route::get('edit/{id}', 'WholeSalesProductsController@edit')->name('admin.wholesales.edit');
        Route::post('update/{id}', 'WholeSalesProductsController@update')->name('admin.wholesales.update');
        Route::get('delete/{id}', 'WholeSalesProductsController@delete')->name('admin.wholesales.delete');

        ######################## End wholesalesproducts Routes  ########################

    });


    ###############3######## Begin Bill Routes ###########################
    Route::group(['prefix' => 'orders'], function () {
        Route::get('customers_orders', 'BillController@getorders')->name('admin.customer.orders');
        Route::get('wholesalers_orders', 'BillController@getWholesalersOrder')->name('admin.wholesaler.orders');
        Route::get('/products/{id}', 'BillController@getordersproducts')->name('admin.orders.get.products');
        Route::get('/wholesales/{id}', 'BillController@getorderswholesales')->name('admin.orders.get.wholesales');
        Route::get('create', 'BillController@create')->name('admin.orders.create');
        Route::post('store', 'BillController@store')->name('admin.orders.store');
//            Route::get('unconfirmed', 'BillController@unconfirmed')->name('admin.orders.unconfirmed');
        Route::get('edit/{id}', 'BillController@edit')->name('admin.orders.edit');
//            Route::post('update/{id}', 'ProductController@update')->name('admin.products.update');
        Route::get('delete/{id}', 'BillController@delete')->name('admin.orders.delete');

        ######################## End Bill Routes  ########################

    });


    ################################## Begin Wholesalers Routes #####################

    //

    ################################## End Wholesalers Routes #####################


    ######################## Begin product order Noti Routes  ########################


    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/', 'NotiController@getUnconfirmedNotification')->name('admin.notifications');
        Route::get('confirm/{id}', 'NotiController@update')->name('admin.notification.update');
        Route::get('delete/{id}', 'NotiController@delete')->name('admin.notification.delete');
//        Route::get('/products/{id}', 'BillController@getordersproducts')->name('admin.orders.get.products');
//        Route::get('create', 'BillController@create')->name('admin.orders.create');
//        Route::post('store', 'BillController@store')->name('admin.orders.store');
//        Route::get('unconfirmed', 'BillController@unconfirmed')->name('admin.orders.unconfirmed');
//        Route::get('edit/{id}', 'BillController@edit')->name('admin.orders.edit');
//        Route::get('delete/{id}', 'BillController@delete')->name('admin.orders.delete');

        ######################## End product order Noti Routes  ########################


    });


    ######################## Begin wholesales order Noti Routes  ########################


    Route::group(['prefix' => 'wholesales_notifications'], function () {
        Route::get('/', 'NotiController@getUnconfirmedWholesalesNotification')->name('admin.wholesales_notifications');
        Route::get('confirm/{id}', 'NotiController@Wholesalesorderupdate')->name('admin.wholesales_notification.update');
        Route::get('delete/{id}', 'NotiController@Wholesalesorderdelete')->name('admin.wholesales_notification.delete');
//        Route::get('/products/{id}', 'BillController@getordersproducts')->name('admin.orders.get.products');
//        Route::get('create', 'BillController@create')->name('admin.orders.create');
//        Route::post('store', 'BillController@store')->name('admin.orders.store');
//        Route::get('unconfirmed', 'BillController@unconfirmed')->name('admin.orders.unconfirmed');
//        Route::get('edit/{id}', 'BillController@edit')->name('admin.orders.edit');
//        Route::get('delete/{id}', 'BillController@delete')->name('admin.orders.delete');

        ######################## End wholesales order Noti Routes  ########################

    });


    ######################## Begin Inventory   Routes  ########################


    Route::group(['prefix' => 'inventory'], function () {
        Route::get('/', 'InventoryController@create')->name('admin.inventory');
        Route::get('/products', 'InventoryController@products')->name('admin.inventory.products');
        Route::post('/products', 'InventoryController@store')->name('admin.inventory.products.store');


        ######################## End Inventory Routes  ########################

    });

  ######################## Begin Customer   Routes  ########################


    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', 'CustomerController@all')->name('admin.customers.all');
        Route::get('vip', 'CustomerController@vip')->name('admin.customers.vip');


        ######################## End Customer Routes  ########################

    });


    ######################## Begin Wholesalers   Routes  ########################


    Route::group(['prefix' => 'wholesalers'], function () {
        Route::get('/', 'WholesalerController@all')->name('admin.wholesalers.all');
        Route::get('vip', 'WholesalerController@vip')->name('admin.wholesalers.vip');
        Route::get('create', 'WholesalerController@create')->name('admin.wholesalers.create');
        Route::post('store', 'WholesalerController@store')->name('admin.wholesalers.store');


        ######################## End Customer Routes  ########################

    });


});


Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'guest:admin'], function () {

    Route::get('login', 'LoginController@getlogin')->name('get.admin.login');
    Route::post('login', 'LoginController@login')->name('admin.login');
});
