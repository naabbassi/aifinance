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
Route::get('/', 'Controller@home')->name('home');
Route::get('/register/{email}','HomeController@Register');
Route::post('/newmember','HomeController@newMember');
Auth::routes();
Route::get('/dashboard', 'HomeController@dashboard');
Route::get('/deposit', 'HomeController@deposit')->name('deposit');
Route::post('/deposit/submit_deposit', 'HomeController@submitDeposit');
Route::get('/finance/history', 'HomeController@history')->name('history');
// Revenue
Route::get('/finance/revenue', 'HomeController@revenue')->name('revenue');
// Withdraw
Route::get('/finance/withdraw','HomeController@withdraw');
Route::post('/finance/withdraw_deposit','HomeController@withdraw_deposit');
Route::post('/finance/withdraw_wallet','HomeController@withdraw_wallet');
// Wallet
Route::get('/finance/wallet', 'HomeController@wallet');
Route::post('/finance/wallet/new', 'HomeController@newWallet');
Route::get('/finance/wallet/edit/{id}', 'HomeController@editWallet');
Route::post('/finance/wallet/update/{id}', 'HomeController@updateWallet');
Route::post('/finance/wallet/delete', 'HomeController@deleteWallet');
// Network
Route::get('/network','HomeController@network');
Route::post('/getnet','HomeController@getnet');
Route::get('/getnet','HomeController@getnetwork');
