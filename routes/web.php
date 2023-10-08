<?php

use App\Http\Controllers\AdminController;
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
//Route Admin
Route::get('/AdminLogin', [AdminController::class , 'loginAdmin']
)->name('back');
Route::post('/AdminLogin', [AdminController::class , 'postLoginAdmin']
)->name('login');
Route::get('/home', function () {
    return view('home');
});
//Route Category
Route::prefix('categories')->group(function () {
    Route::get('/', [
        'as' => 'categories.list',
        'uses' =>  'App\Http\Controllers\CategoryController@list'
    ]
       
    );
    Route::get('/create', [
        'as' => 'categories.create',
        'uses' =>  'App\Http\Controllers\CategoryController@create',
    ]
       
    );
    Route::post('/store', [
        'as' => 'categories.store',
        'uses' =>  'App\Http\Controllers\CategoryController@store',
        
       

    ]
       
    );
    Route::get('/edit/{id}', [
        'as' => 'categories.edit',
        'uses' =>  'App\Http\Controllers\CategoryController@edit',
    ]
       
    );
    Route::get('/delete/{id}', [
        'as' => 'categories.delete',
        'uses' =>  'App\Http\Controllers\CategoryController@delete',
    ]
       
    );
    Route::post('/update/{id}', [
        'as' => 'categories.update',
        'uses' =>  'App\Http\Controllers\CategoryController@update',
    ]
       
    );
});

//route menus
Route::prefix('menus')->group(function () {
    Route::get('/', [
        'as' => 'menus.list',
        'uses' =>  'App\Http\Controllers\MenuController@list'
    ]
       
    );
    Route::get('/create', [
        'as' => 'menu.create',
        'uses' =>  'App\Http\Controllers\MenuController@create',
    ]
       
    );
    Route::post('/store', [
        'as' => 'menu.store',
        'uses' =>  'App\Http\Controllers\MenuController@store',
    ]
       
    );
    Route::get('/edit/{id}', [
        'as' => 'menu.edit',
        'uses' =>  'App\Http\Controllers\MenuController@edit',
    ]
       
    );
    Route::post('/update/{id}', [
        'as' => 'menu.update',
        'uses' =>  'App\Http\Controllers\MenuController@update',
    ]
       
    );
    Route::get('/delete/{id}', [
        'as' => 'menu.delete',
        'uses' =>  'App\Http\Controllers\MenuController@delete',
    ]
       
    );
});
//route product
Route::prefix('products')->group(function () {
    Route::get('/', [
        'as' => 'product.list',
        'uses' =>  'App\Http\Controllers\AdminProductController@list'
    ]
       
    );
    Route::get('/create', [
        'as' => 'product.create',
        'uses' =>  'App\Http\Controllers\AdminProductController@create',
    ]
);
});