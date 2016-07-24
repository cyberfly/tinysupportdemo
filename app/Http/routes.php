<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::post('tickets/comment/{tickets}','TicketsController@storeComment')->name('tickets.storeComment');
Route::resource('tickets','TicketsController');

Route::group(['prefix' => 'helpdesk'], function () {
    Route::post('helpdesk/tickets/comment/{tickets}','Helpdesk\HelpdeskTicketsController@storeComment')->name('helpdesk.tickets.storeComment');
    Route::resource('tickets','Helpdesk\HelpdeskTicketsController');
});

