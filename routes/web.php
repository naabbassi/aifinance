<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/', 'Controller@home')->name('home');
// Registeration
Route::get('/register/{email}','HomeController@Register');
Route::post('/newmember','HomeController@newMember');
Auth::routes();
// Dashboard
Route::get('/dashboard', 'HomeController@dashboard');
// Deposit
Route::get('/deposit', 'HomeController@deposit')->name('deposit');
Route::post('/deposit/submit_deposit', 'HomeController@submitDeposit');
// History
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
//issues
Route::post('/issue/submit','HomeController@issueSubmit');
Route::get('/tickets','HomeController@tickets');
Route::get('tickets/issue/open/{id}','HomeController@ticketDetail');
Route::get('/tickets/newTicket','HomeController@newTicket');
Route::post('/issue/closeIssue','HomeController@closeIssue');
Route::post('/issue/{id}/submit','HomeController@submitDetail');
//Profile
Route::get('user/profile', 'HomeController@getProfile')->name('profile');
Route::post('user/profile/update', 'HomeController@updateProfile');
Route::post('user/profile/password/update', 'HomeController@updatePassword');
//Loan
Route::get('loan','HomeController@loan');
//FAQ and Downloads
Route::get('/faq','HomeController@faq');
Route::get('/downloads','HomeController@downloads');
//Administration routing
Route::get('/admin','AdminController@home');
Route::get('/admin/deposit','AdminController@deposits');
Route::get('/admin/users','AdminController@users');
Route::get('/admin/tickets','AdminController@tickets');