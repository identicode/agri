<?php

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
    return redirect('/seller/list');
});

Route::get('/home', function () {
    return redirect('/seller/list');
})->name('home');

Auth::routes();


Route::get('/dashboard', 'DashboardController@index');

Route::prefix('seller')->group(function(){
	Route::get('/list', 'SellerController@index');
	Route::get('/show/{id}', 'SellerController@show');
	Route::get('/add', 'SellerController@create');
	Route::get('/edit/{id}', 'SellerController@edit');
	Route::post('/', 'SellerController@store');
	Route::get('/delete/{id}', 'SellerController@destroy');
	Route::post('/update/{id}', 'SellerController@update');
});

Route::prefix('producer')->group(function(){
	Route::get('/list', 'ProducerController@index');
	Route::get('/show/{id}', 'ProducerController@show');
	Route::get('/add', 'ProducerController@create');
	Route::get('/edit/{id}', 'ProducerController@edit');
	Route::post('/', 'ProducerController@store');
	Route::get('/delete/{id}', 'ProducerController@destroy');
	Route::post('/update/{id}', 'ProducerController@update');
});

Route::prefix('dealer')->group(function(){
	Route::get('/', 'DealerController@index');
	Route::post('/', 'DealerController@store');
	Route::put('/', 'DealerController@update');
	Route::get('/delete/{id}', 'DealerController@destroy');
});

Route::prefix('category')->group(function(){
	Route::get('/', 'CategoryController@index');
	Route::post('/', 'CategoryController@store');
	Route::put('/', 'CategoryController@update');
	Route::get('/delete/{id}', 'CategoryController@destroy');
});


Route::prefix('product')->group(function(){
	Route::get('/', 'ProductController@index');
	Route::post('/', 'ProductController@store');
	Route::put('/', 'ProductController@update');
	Route::get('/delete/{id}', 'ProductController@destroy');
	Route::get('/print/seller', 'ProductController@print');
});

Route::prefix('settings')->group(function(){

	Route::prefix('profile')->group(function(){
		Route::get('/', 'ProfileController@index');
		Route::post('/info', 'ProfileController@info');
		Route::post('/avatar', 'ProfileController@avatar');
		Route::post('/username', 'ProfileController@username');
		Route::post('/password', 'ProfileController@password');
		Route::post('/question', 'ProfileController@question');
	});

	Route::prefix('logs')->group(function(){
		Route::get('/', 'LogController@index');
	});

	Route::get('/account', 'ProfileController@addAdmin');
	Route::post('/account', 'ProfileController@storeAdmin');

	
});

Route::get('/forgot-password', 'Auth\ForgotController@form');
Route::put('/forgot-password', 'Auth\ForgotController@search');
Route::post('/forgot-password', 'Auth\ForgotController@security');
Route::post('/change-password', 'Auth\ForgotController@change');

