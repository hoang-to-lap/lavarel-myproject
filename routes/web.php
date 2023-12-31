<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
Route::get('/AdminLogout', [AdminController::class , 'logoutAdmin']
)->name('goback');
// Route::get('/home', function () {
//     return view('home');
// });
Route::get('/home', [AdminController::class,'showhome'])->name('showhome');
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
Route::post('/store', [
    'as' => 'product.store',
    'uses' =>  'App\Http\Controllers\AdminProductController@store',
]
);
Route::get('/edit/{id}', [
    'as' => 'product.edit',
    'uses' =>  'App\Http\Controllers\AdminProductController@edit',
]
);
Route::post('/update/{id}', [
    'as' => 'product.update',
    'uses' =>  'App\Http\Controllers\AdminProductController@update',
]
);
Route::get('/delete/{id}', [
    'as' => 'product.delete',
    'uses' =>  'App\Http\Controllers\AdminProductController@delete',
]
);
});
//fontend 
Route::get('/', [HomeController::class , 'index']
)->name('home.shop');
Route::get('/myshop', [HomeController::class , 'shop']
)->name('shop.product');
Route::get('/product/{slug}/{id}', [
    'as' => 'shop.productofcategory',
    'uses' =>  'App\Http\Controllers\CategoryController@productOfCategory',
    ]
);
Route::get('/detail/{id}', [HomeController::class , 'detail']
)->name('product.detail');
Route::get('/search/', [HomeController::class , 'search']
)->name('product.search');
Route::get('/loginuser', [HomeController::class , 'login']
)->name('login.user');
Route::get('/registeruser', [HomeController::class , 'dangki']
)->name('dangki.user');
Route::post('/dangki', [HomeController::class , 'createaccount']
)->name('create.user');
Route::post('/dangnhap', [HomeController::class , 'dangnhap']
)->name('dangnhap.user');
Route::get('/userlogout', [HomeController::class , 'logoutUser']
)->name('logout');
// Shopping cart
Route::post('/cart/{id}',[CartController::class,'addcart'])->name('addcart');
Route::get('/showcart',[CartController::class,'showcart'])->name('showcart');
Route::get('/deletecart/{id}',[CartController::class,'deletecart'])->name('deletecart');
Route::get('/clear',[CartController::class,'clear'])->name('clearcart');
Route::get('/updategiam/{id}',[CartController::class,'updategiam'])->name('updatecart.giam');
Route::get('/updatetang/{id}',[CartController::class,'updatetang'])->name('updatecart.tang');
Route::get('/updatecart',[CartController::class,'updateCart'])->name('updatecart');