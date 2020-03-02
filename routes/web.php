<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/', 'Controller@home')->name('home');
Route::post('/', 'Controller@subscribe');
Route::get('/sendsms/{number}', 'Controller@sendSMS');
Route::get('/web', 'Controller@home');
Route::get('/web/about', 'Controller@about');
Route::get('/web/blog', 'Controller@blog');
Route::get('/web/blog/{postId}', 'Controller@post');
Route::get('/web/contact', 'Controller@contact');
Route::post('/web/contact', 'Controller@contactForm');
Route::get('/web/help', 'Controller@help');
Route::get('/web/trade', 'Controller@trade');
Route::get('/web/investment', 'Controller@investment');
// Registration
Route::get('/register/{email}','Controller@register');
Route::post('/newmember','Controller@newMember');
//enable authentication for next routes
Auth::routes();
// Dashboard
Route::get('/dashboard', 'HomeController@dashboard');
// Deposit
Route::get('/deposit', 'HomeController@deposit')->name('deposit');
Route::post('/deposit/submit_deposit', 'HomeController@submitDeposit');
// History
Route::get('/finance/history', 'HomeController@history')->name('history');
Route::get('/finance/reports', 'HomeController@reports');
// Revenue
Route::get('/finance/revenue', 'HomeController@revenue')->name('revenue');
Route::get('/finance/revenue/details/{id}', 'HomeController@revenue_details')->name('revenue');
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
Route::get('/admin/dashboard','AdminController@home');
Route::get('/admin/deposit','AdminController@deposits');
Route::get('/admin/users','AdminController@users');
Route::get('/admin/users/{id}','AdminController@userDetails');
Route::post('/admin/users/update/{userId}','AdminController@updateProfile');
Route::post('/admin/users/{userId}','AdminController@changeUserPassword');
Route::post('/admin/users/active/{userId}','AdminController@disableUser');
Route::get('/admin/tickets','AdminController@tickets');
Route::get('/admin/tickets/{ticketId}','AdminController@showTicket');
Route::post('/admin/issue/{ticketId}/','AdminController@submitTicketDetail');
Route::post('/admin/deposit/confirm','AdminController@confirmDeposit');
Route::get('/admin/faq','AdminController@faq');
Route::post('/admin/faq/new','AdminController@faqNew');
Route::post('/admin/faq/get/{id}','AdminController@getFaqById');
Route::get('/admin/withdraw','AdminController@withdraw');
Route::post('/admin/withdraw/details','AdminController@withdrawDetails');
Route::put('/admin/withdraw/confirm','AdminController@withdrawConfirm');
Route::get('/admin/blog','AdminController@blogs');
Route::post('/admin/blog','AdminController@createOrUpdatePost');
Route::post('/admin/blog/{postId}','AdminController@getPostById');
Route::delete('/admin/blog/{postId}','AdminController@deletePostById');
Route::get('/admin/msg','AdminController@messages');