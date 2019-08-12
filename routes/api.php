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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/testjson', function () {
    $contacts =  Contact::all();
    return response()->json($contacts);
});

Route::get('/contacts', 'ContactsAPIController@listContacts');
Route::get('/messages', 'MessagesAPIController@listMessages');
Route::get('/contact/{id}', 'ContactsAPIController@show');
Route::get('/contact/{id}/messages', 'MessagesAPIController@messagesByContact');
Route::get('/message/{id}', 'MessagesAPIController@show');
Route::delete('/message/delete/{id}', 'MessagesAPIController@destroy');













Route::get('/bycontact2', function () {
    echo view('routes');
    
    $item = Contact::all();
    if(count($item) === 0 ){
        echo "You have no contacts.";
    }else{
        foreach ($item as $it)
        {
         echo $it->id . " - " . $it->fname . " ";
         $phones = $it->phones;
         foreach ($phones as $p){
             echo $p->number . " (" . $p->apps . ") ";
         }
         echo "<hr>";
        }
    }
});