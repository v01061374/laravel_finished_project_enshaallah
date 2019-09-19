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
    });
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

});
