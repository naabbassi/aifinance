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
Route::get('/', 'Controller@home');
Auth::routes();
Route::get('/dashboard', 'HomeController@dashboard');
Route::get('/deposit', 'HomeController@deposit')->name('deposit');
Route::get('/finance/history', 'HomeController@history')->name('history');
// Wallet
Route::get('/finance/wallet', 'HomeController@wallet');
Route::post('/finance/wallet/new', 'HomeController@newWallet');
Route::get('/finance/wallet/edit/{id}', 'HomeController@editWallet');
Route::post('/finance/wallet/update/{id}', 'HomeController@updateWallet');
// Network
Route::get('/network','HomeController@network');
