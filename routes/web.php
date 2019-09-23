<?php

use App\CustomClasses\Hasher;

Route::bind('id', function ($id) {
    try{
        return Hasher::decode($id);
    } catch(Exception $e){
        abort(404);
    }

});
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

Route::get('/', function () {
    return view('dashboard.index');
});

Route::prefix('dashboard')->group(function (){
    Route::get('/', function (){
       return view('dashboard.index');
    })->name('dashboard');
    Route::prefix('suppliers')->group(function (){
       Route::get('/', 'SuppliersController@index')->name('suppliers.index');
       Route::get('/create', 'SuppliersController@create')->name('suppliers.create');
       Route::post('/store', 'SuppliersController@store')->name('suppliers.store');
       Route::get('/edit/{id}','SuppliersController@edit')->name('suppliers.edit');
       Route::post('/update/{id}','SuppliersController@update')->name('suppliers.update');
       Route::get('/delete/{id}','SuppliersController@destroy')->name('suppliers.delete');
    });
    Route::prefix('sizes')->group(function (){
        Route::get('/', 'SizesController@index')->name('sizes.index');
        Route::get('/create', 'SizesController@create')->name('sizes.create');
        Route::post('/store', 'SizesController@store')->name('sizes.store');
        Route::get('/edit/{id}','SizesController@edit')->name('sizes.edit');
        Route::post('/update/{id}','SizesController@update')->name('sizes.update');
        Route::get('/delete/{id}','SizesController@destroy')->name('sizes.delete');
    });
    Route::prefix('weights')->group(function (){
        Route::get('/', 'WeightsController@index')->name('weights.index');
        Route::get('/create', 'WeightsController@create')->name('weights.create');
        Route::post('/store', 'WeightsController@store')->name('weights.store');
        Route::get('/edit/{id}','WeightsController@edit')->name('weights.edit');
        Route::post('/update/{id}','WeightsController@update')->name('weights.update');
        Route::get('/delete/{id}','WeightsController@destroy')->name('weights.delete');
    });
    Route::prefix('productCategories')->group(function (){
        Route::get('/', 'ProductCategoriesController@index')->name('productCategories.index');
        Route::get('/create', 'ProductCategoriesController@create')->name('productCategories.create');
        Route::post('/store', 'ProductCategoriesController@store')->name('productCategories.store');
        Route::get('/edit/{id}','ProductCategoriesController@edit')->name('productCategories.edit');
        Route::post('/update/{id}','ProductCategoriesController@update')->name('productCategories.update');
        Route::get('/delete/{id}','ProductCategoriesController@destroy')->name('productCategories.delete');
    });
    Route::prefix('materialCategories')->group(function (){
        Route::get('/', 'MaterialCategoriesController@index')->name('materialCategories.index');
        Route::get('/create', 'MaterialCategoriesController@create')->name('materialCategories.create');
        Route::post('/store', 'MaterialCategoriesController@store')->name('materialCategories.store');
        Route::get('/edit/{id}','MaterialCategoriesController@edit')->name('materialCategories.edit');
        Route::post('/update/{id}','MaterialCategoriesController@update')->name('materialCategories.update');
        Route::get('/delete/{id}','MaterialCategoriesController@destroy')->name('materialCategories.delete');
    });


    Route::prefix('tools')->group(function (){
        Route::get('/', 'ToolsController@index')->name('tools.index');
        Route::get('/create', 'ToolsController@create')->name('tools.create');
        Route::post('/store', 'ToolsController@store')->name('tools.store');
        Route::get('/edit/{id}','ToolsController@edit')->name('tools.edit');
        Route::post('/update/{id}','ToolsController@update')->name('tools.update');
        Route::get('/delete/{id}','ToolsController@destroy')->name('tools.delete');
    });
    Route::prefix('products')->group(function (){
        Route::get('/', 'ProductsController@index')->name('products.index');
        Route::get('/create', 'ProductsController@create')->name('products.create');
        Route::post('/store', 'ProductsController@store')->name('products.store');
        Route::get('/edit/{id}','ProductsController@edit')->name('products.edit');
        Route::post('/update/{id}','ProductsController@update')->name('products.update');
        Route::get('/delete/{id}','ProductsController@destroy')->name('products.delete');
    });
    Route::prefix('materials')->group(function (){
        Route::get('/', 'MaterialsController@index')->name('materials.index');
        Route::get('/create', 'MaterialsController@create')->name('materials.create');
        Route::post('/store', 'MaterialsController@store')->name('materials.store');
        Route::get('/edit/{id}','MaterialsController@edit')->name('materials.edit');
        Route::post('/update/{id}','MaterialsController@update')->name('materials.update');
        Route::get('/delete/{id}','MaterialsController@destroy')->name('materials.delete');
    });
    Route::prefix('stocks')->group(function (){
        Route::get('/', 'StocksController@index')->name('stocks.index');
        Route::get('/create', 'StocksController@create')->name('stocks.create');
        Route::post('/store', 'StocksController@store')->name('stocks.store');
        Route::get('/edit/{id}','StocksController@edit')->name('stocks.edit');
        Route::post('/update/{id}','StocksController@update')->name('stocks.update');
        Route::get('/delete/{id}','StocksController@destroy')->name('stocks.delete');
    });
    Route::prefix('purchases')->group(function (){
        Route::get('/', 'PurchasesController@index')->name('purchases.index');
        Route::get('/create', 'PurchasesController@create')->name('purchases.create');
        Route::post('/store', 'PurchasesController@store')->name('purchases.store');
        Route::get('/edit/{id}','PurchasesController@edit')->name('purchases.edit');
        Route::post('/update/{id}','PurchasesController@update')->name('purchases.update');
        Route::get('/delete/{id}','PurchasesController@destroy')->name('purchases.delete');
    });
    Route::prefix('receipts')->group(function (){
        Route::get('/', 'ReceiptsController@index')->name('receipts.index');
        Route::get('/create', 'ReceiptsController@create')->name('receipts.create');
        Route::post('/store', 'ReceiptsController@store')->name('receipts.store');
        Route::get('/edit/{id}','ReceiptsController@edit')->name('receipts.edit');
        Route::post('/update/{id}','ReceiptsController@update')->name('receipts.update');
        Route::get('/delete/{id}','ReceiptsController@destroy')->name('receipts.delete');
    });
    Route::prefix('sells')->group(function (){
        Route::get('/', 'SellsController@index')->name('sells.index');
        Route::get('/create', 'SellsController@create')->name('sells.create');
        Route::post('/store', 'SellsController@store')->name('sells.store');
        Route::get('/edit/{id}','SellsController@edit')->name('sells.edit');
        Route::post('/update/{id}','SellsController@update')->name('sells.update');
        Route::get('/delete/{id}','SellsController@destroy')->name('sells.delete');
    });
    Route::prefix('digiStocks')->group(function (){
        Route::get('/', 'DigiStocksController@index')->name('digiStocks.index');
        Route::get('/create', 'DigiStocksController@create')->name('digiStocks.create');
        Route::post('/store', 'DigiStocksController@store')->name('digiStocks.store');
        Route::get('/edit/{id}','DigiStocksController@edit')->name('digiStocks.edit');
        Route::post('/update/{id}','DigiStocksController@update')->name('digiStocks.update');
        Route::get('/delete/{id}','DigiStocksController@destroy')->name('digiStocks.delete');
    });
    Route::prefix('packages')->group(function (){
        Route::get('/', 'PackagesController@index')->name('packages.index');
        Route::get('/create', 'PackagesController@create')->name('packages.create');
        Route::post('/store', 'PackagesController@store')->name('packages.store');
        Route::get('/edit/{id}','PackagesController@edit')->name('packages.edit');
        Route::post('/update/{id}','PackagesController@update')->name('packages.update');
        Route::get('/delete/{id}','PackagesController@destroy')->name('packages.delete');
    });

});
