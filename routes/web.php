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

Route::get('/', function () {
    echo view('routes');    
    return view('welcome');
});

Route::get('/routes', function () {
   return view('routes');
});

Route::get('/contacts', function () {
    echo view('routes');
    
    $cont = Contact::all();
    if(count($cont) === 0 ){
        echo "You have no contact.";
    }else{
        foreach ($cont as $c){
            echo "- " . $c->fname ." " . $c->lname . " | " . $c->email. "<br>";
        }
    }
});

Route::get('/phones', function () {
    echo view('routes');
    
    $phone = Phone::all();
    if(count($phone) === 0 ){
        echo "You have no phone.";
    }else{
        echo "<table border='1'>
        <thead>
        <tr>
            <th>Name</th>
            <th>Number</th>
            <th>Number type</th>
            <th>Apps</th>
            <th>E-mail</th>
            <th></th>
        </tr>
        </thead>
        <tbody>";
        foreach ($phone as $p){
            echo "<tr>
                <td>" . $p->contact->fname . " " . $p->contact->lname . "</td>
                <td>" . $p->number . "</td>
                <td>" . $p->type . "</td>
                <td>" . $p->apps . "</td>
                <td>" . $p->contact->email . "</td>
                <td>" . " Edit | Delete" . "</td>
            </tr>";

        }
        echo "</tbody>
        </table>";
    }
});

Route::get('/list', function () {
    echo view('routes');

    $item = Phone::all();
    if(count($item) === 0 ){
        echo "You have no contacts.";
    }else{
        echo "<table border='1'>
        <thead>
        <tr>
            <th>Name</th>
            <th>Number</th>
            <th>Number type</th>
            <th>Apps</th>
            <th>E-mail</th>
            <th></th>
        </tr>
        </thead>
        <tbody>";
        foreach ($item as $it){
            echo "<tr>
                <td>" . $it->contact->fname . " " . $it->contact->lname . "</td>
                <td>" . $it->number . "</td>
                <td>" . $it->type . "</td>
                <td>" . $it->apps . "</td>
                <td>" . $it->contact->email . "</td>
                <td>" . " Edit | Delete" . "</td>
            </tr>";

        }
        echo "</tbody>
        </table>";
    }
});

Route::get('/bycontact', function () {
    echo view('routes');

    $item = Contact::all();
    if(count($item) === 0 ){
        echo "You have no contacts.";
    }else{
        echo "<table border='1'>
        <thead>
        <tr>
            <th>Name</th>
            <th>Numbers</th>
            <th>E-mail</th>
            <th></th>
        </tr>
        </thead>
        <tbody>";
        foreach ($item as $it){
            $phoneColection = App\Phone::where('contact_id', $it->id)->get();
            $phones = "";
            foreach ($phoneColection as $phone) {
                $phones .= $phone->number." (".$phone->apps.") ";
            }

            echo "<tr>
                <td>" . $it->fname . " " . $it->lname . "</td>
                <td>" . $phones . "</td>
                ";
            echo "<td>" . $it->email . "</td>
                <td>" . " Edit | Delete" . "</td>
            </tr>";

        }
        echo "</tbody>
        </table>";
    }
});

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

Route::get('/messages', function () {
   $messages = Message::all();
   $phones = Phone::all();
   $contacts = Contact::all();
   return view('front/messages', compact('messages', 'phones', 'contacts'));
});

// Route::get('/messagesbycontact', function () {
//     echo view('routes');
    
//     $item = Contact::all();
//     if(count($item) === 0 ){
//         echo "You have no messages.";
//     }else{
//         foreach ($item as $it)
//         {
//          $messages = $it->messages;
//          foreach ($messages as $m){
//              echo "Subject: ". $m->subject . "<br>";
//              echo "From: ". $m->subject . "<br>";
//              echo "Message:<br>".  $m->message . "<hr>";
//          }
//         }
//     }
// });

Route::get('/messagesbycontact', function () {
    echo view('routes');
    
    $item = Contact::all();
    if(count($item) === 0 ){
        echo "You have no messages.";
    }else{
        foreach ($item as $it)
        {
            echo "[ " . $it->fname . "]<br>______________<br>";
            $messages = $it->messages;
         foreach ($messages as $p){
            echo $p->subject . " | ";
         }
         echo "<hr>";
        }
    }
});