<?php

use Illuminate\Http\Request;
use App\Contact;
use App\Phone;
use App\Message;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::name('api.')->group(function () {
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    //Contacts
    Route::get('/contacts', 'ContactsAPIController@listContacts');
    Route::post('/contacts', 'ContactsAPIController@store');
    Route::post('/contactandphone', 'ContactsAPIController@storeContactAndPhone');
    Route::get('/contact/{id}', 'ContactsAPIController@show');
    Route::delete('/contact/{id}', 'ContactsAPIController@destroy');
    Route::put('/contact/{id}', 'ContactsAPIController@update');
    Route::get('/phone/{id}', 'ContactsAPIController@showPhone');
    Route::put('/phone/{id}', 'ContactsAPIController@updatePhone');
    Route::delete('/phone/{id}', 'ContactsAPIController@destroyPhone');
    Route::get('/contact/{id}/phones', 'ContactsAPIController@phonesByContact');
    Route::post('/contacts/search', 'ContactsAPIController@searchApi')->name('searchapi');

    //Messages
    Route::get('/messages', 'MessagesAPIController@listMessages');
    Route::post('/messages', 'MessagesAPIController@store');
    Route::get('/contact/{id}/messages', 'MessagesAPIController@messagesByContact')->name('messagesbycontact');
    Route::get('/message/{id}', 'MessagesAPIController@show');
    Route::put('/message/{id}', 'MessagesAPIController@update');
    Route::delete('/message/delete/{id}', 'MessagesAPIController@destroy');
});