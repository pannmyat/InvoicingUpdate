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

Route::get('/', 'HomeController@index')->name('home');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index');	
   	Route::get('/invoices/create', 'InvoicesController@create');
   	Route::post('/invoices/create', 'InvoicesController@store');   	
   	Route::get('/invoices/show','InvoicesController@show');	
	Route::delete('/invoices/delete/{id}','InvoicesController@destroy');
	Route::get('/invoices/edit/{id}','InvoicesController@edit');
	Route::put('/invoices/edit/{id}','InvoicesController@update');
	Route::get('/invoices/pdf/{id}','InvoicesController@pdf');
});






