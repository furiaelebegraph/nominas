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
    return view('welcome');
})->name('index');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware'=> 'auth'],function(){
  Route::resource('seller','HomeController', ['only' => ['create', 'store', 'edit']]);
  Route::get('seller','HomeController@indexSeller')->name('seller.index');
  Route::post('seller/{id}/update','HomeController@update');
  Route::delete('seller/{id}/delete','HomeController@destroy')->name('seller.destroy');
  Route::get('seller/{id}/deleteMsg','HomeController@DeleteMsg');
});

Route::get('buscanomina', 'NominaController@buscador');

Route::get('buscacolaborador', 'SellerController@buscador');

Route::group(['middleware'=> 'auth'],function(){
  Route::resource('nomina','NominaController',['names' => ['nominas' => 'nomina.index', 'edit' => 'nomina.edit',]], ['only' => ['create', 'store', 'index', 'edit']]);
  Route::post('nomina/{id}/update','NominaController@update'); 
  Route::delete('nomina/{id}/delete','NominaController@destroy')->name('nomina.destroy');
  Route::get('nomina/{id}/deleteMsg','NominaController@DeleteMsg');
});
//Logged in users/seller cannot access or send requests these pages
Route::group(['seller_guest'], function() {

	Route::get('seller_register', 'SellerAuth\RegisterController@showRegistrationForm')->name('seller_register');
	Route::post('seller_register', 'SellerAuth\RegisterController@register');
	Route::get('seller_login', 'SellerAuth\LoginController@showLoginForm')->name('seller_login');
	Route::post('seller_login', 'SellerAuth\LoginController@login');

	//Password reset routes
	Route::get('seller_password/reset', 'SellerAuth\ForgotPasswordController@showLinkRequestForm');
	Route::post('seller_password/email', 'SellerAuth\ForgotPasswordController@sendResetLinkEmail');
	Route::get('seller_password/reset/{token}', 'SellerAuth\ResetPasswordController@showResetForm');
	Route::post('seller_password/reset', 'SellerAuth\ResetPasswordController@reset');

});

Route::get('verificar/{correo}/{emailtoken}', 'SellerAuth\RegisterController@enviarCorreoListo')->name('enviarCorreoListo');

//Only logged in sellers can access or send requests to these pages
Route::group(['middleware' => 'auth:web_seller'], function(){

	Route::post('seller_logout', 'SellerAuth\LoginController@logout')->name('seller_logout');
	Route::get('/dash','SellerController@index')->name('dash');

});
