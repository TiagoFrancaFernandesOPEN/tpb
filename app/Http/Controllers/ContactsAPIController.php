<?php

namespace App\Http\Controllers;

function vd($item){
    var_dump($item);
}

use Illuminate\Http\Request;
use App\Contact;
use App\Phone;
use App\Message;

class ContactsAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->listContacts();
    }

    public function listContacts()
    {
        $contactsArray = array();
        $contacts = \App\Contact::all();
        if(count($contacts) === 0 ){
           // echo "You have no contacts.";
        }else{
            foreach ($contacts as $c)
            {
            $phones = $c->phones;
            $phonesArr = array();
            foreach ($phones as $p){
                $numApps = ['number' => $p->number, 'apps' => $p->apps];
                array_push($phonesArr, $numApps);
            }
            array_push($contactsArray, [
                'id' => $c->id, 'name' => $c->fname, 'lastname' => $c->lname, 'phones' => $phonesArr
                ]);
            }
        }

        return response()->json($contactsArray);
    }

    
    

    // public function create()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
