<?php
function vd($item){
    var_dump($item);
}
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
use App\Contact;
use App\Phone;
use App\Message;

Route::get('/', array('as' => 'site_home', function () {
   $messages = Message::all();
   $phones = Phone::all();
   $contacts = Contact::all();
   return view('front/pages/contacts', compact('messages', 'phones', 'contacts'));
}));

Route::get('/contact/{id}', array('as' => 'cont_id', function ($id){
    return route('cont_id',$id);
}));

Route::get('/contacts', array('as' => 'site_contacts', function () {    
   $messages = Message::all();
   $phones = Phone::all();
   $contacts = Contact::all();
   return view('front/pages/contacts', compact('messages', 'phones', 'contacts'));
}));

Route::get('/messages', function () {
   $messages = Message::all();
   $phones = Phone::all();
   $contacts = Contact::all();
   return view('front/pages/messages', compact('messages', 'phones', 'contacts'));
});

Route::get('/routes', function () {
   return view('routes');
});

Route::get('/contacts/search', function () {
   return view('routes');
});
Route::post('/contacts/search', 'ContactsAPIController@searchForm');
