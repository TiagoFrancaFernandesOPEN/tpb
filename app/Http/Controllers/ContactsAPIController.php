<?php

namespace App\Http\Controllers;

function vd($item){
    var_dump($item);
}

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
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
            $phone = (isset($c->phones->first()->number))?$c->phones->first()->number:'';
            $phonesArr = array();
            foreach ($phones as $p){
                $numApps = ['number' => $p->number, 'apps' => $p->apps];
                array_push($phonesArr, $numApps);
            }
            array_push($contactsArray, [
                'id' => $c->id, 'fname' => $c->fname, 'lname' => $c->lname,
                'email' => $c->email,
                "contact_full_name" => $c->fname . ' ' . $c->lname,
                'phone' => $phone, 'phones' => $phonesArr
                ]);
            }
        }

        return response()->json($contactsArray);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contact = new Contact;
        $contact->fname = $request->input('fname');
        $contact->lname = $request->input('lname');
        $contact->email = $request->input('email');
        $contact->save();
        
        return response()->json($contact, 201);
    }

     public function storeContactAndPhone(Request $request)
    {
        $contactFull = array();
        $contact = new Contact;
        $phone = new Phone;
        $contact->fname = $request->input('fname');
        $contact->lname = $request->input('lname');
        $contact->email = $request->input('email');
        $contact->save();
        $phone->number = $request->input('number');
        $phone->type = $request->input('type');
        $phone->apps = $request->input('apps');
        $phone->contact_id = $contact->id;
        $phone->save();
        array_push($contactFull, $contact);
        array_push($contactFull, $phone);
        
        return response()->json($contactFull, 201);
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        if(isset($contact))
        {
            $firstPhone = Phone::where('contact_id', $id)->first();
            $collections = Phone::where('contact_id', $id);
            $result = (int) $collections->count();
            $phones = $collections->get();
            $arrayOfPhones = array();
            foreach ($phones as $p)
            {
                $phoneData = 
                [
                    'id' => $p->id,
                    'contact_id' => $p->contact->id, 
                    'apps' => $p->apps, 
                    'type' => $p->type,
                    'number' => $p->number
                ];
                array_push($arrayOfPhones, $phoneData);
            }

            $data = [
                "id" => $contact->id,
                "fname" => $contact->fname,
                "lname" => $contact->lname,
                "contact_full_name" => $contact->fname . ' ' . $contact->lname,
                "email" => $contact->email,
                "phone" => $firstPhone,
                "phones" => $arrayOfPhones,
                "created_at" => $contact->created_at,
                "updated_at" => $contact->updated_at
            ];

            return Response()->json($data, 202);
        }else{
            $data =
            [
                'status' => '404', 'callback_message' => 'Not found!',
                'action' => 'show', 'target' =>  $id
            ];
            return Response()->json($data, 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSimple($id)
    {
         $contact = Contact::find($id);
        if (isset($contact))
        {
            return response()->json($contact, 201);
        }
        $data =
        [
            'status' => '404', 'callback_message' => 'Not found!',
            'action' => 'show', 'target' =>  $id
        ];
        return Response()->json($data, 404);
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
        $contact = Contact::find($id);
        if (isset($contact))
        {
            $contact = new Contact;
            $contact->fname = $request->input('fname');
            $contact->lname = $request->input('lname');
            $contact->email = $request->input('email');
            $contact->save();
        
            return response()->json($contact, 201);
        }
        $data =
        [
            'status' => '404', 'callback_message' => 'Not found!',
            'action' => 'show', 'target' =>  $id
        ];
        return Response()->json($data, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
     {
        Phone::where('contact_id', $id)->delete();
        Message::where('contact_id', $id)->delete();        
        $contact = Contact::find($id);

        if(isset($contact))
        {
            if($contact->delete())
            {
                $data =
                [ 
                    'status' => '202', 'callback_message' => 'Deleted!',
                    'action' => 'delete', 'target' =>  $id
                ];
                return Response()->json($data, 202);
            }
        }else
        {
            $data =
            [
                'status' => '404', 'callback_message' => 'Not found!',
                'action' => 'delete', 'target' =>  $id
            ];
            return Response()->json($data, 404);
        }
        
    }

    public function searchApi(Request $request)
    {
        $search = $request->phrase;
        $collections = Contact::where('fname', 'like', '%'.$search.'%')
            ->orWhere('lname', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%')

        ->join('phones', 'contacts.id', '=', 'phones.contact_id')
        ->select('contacts.*', 'phones.*')
        ->orWhere('phones.number', 'like', '%'.$search.'%')
        ->get();

        $convert = array();
        foreach ($collections as $k)
        {
            $a = [
            "id"=> $k->id,
            "fname"=> $k->fname,
            "lname" => $k->lname,
            "email" => $k->email,
            "number" => $k->number,
            "type" => $k->type,
            "apps" => $k->apps,
            "contact_id" => $k->contact_id,
            "profile_url" => route('cont_id',$k->contact_id),
            "updated_at" => $k->updated_at,
            "created_at" => $k->created_at,
            ];
            array_push($convert, $a);
        }

        return response()->json($convert);
    }

       public function searchForm(Request $request)
    {
        $search = $request->phrase;
        $collections = Contact::where('fname', 'like', '%'.$search.'%')
            ->orWhere('lname', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%')

        ->join('phones', 'contacts.id', '=', 'phones.contact_id')
        ->select('contacts.*', 'phones.*')
        ->orWhere('phones.number', 'like', '%'.$search.'%')
        ->get();

        $results = array();
        foreach ($collections as $k)
        {
            $a = [
            "id"=> $k->id,
            "fname"=> $k->fname,
            "lname" => $k->lname,
            "email" => $k->email,
            "number" => $k->number,
            "type" => $k->type,
            "apps" => $k->apps,
            "contact_id" => $k->contact_id,
            "profile_url" => route('cont_id',$k->contact_id),
            "updated_at" => $k->updated_at,
            "created_at" => $k->created_at,
            ];
            array_push($results, $a);
        }

        // return response()->json($results);
        // print_r($results);
        // $results = (object)$results;
        return view('front/pages/search', compact('results'));
    }

    public function phonesByContact($id)
    {
        $collections = Phone::where('contact_id', $id);
        $result = (int) $collections->count();
        $phones = $collections->get();
        $arrayOfPhones = array();
        
        if($result <= 0 ){
            $arrayOfPhones = ['error' => 'You have no phones.'];
        }else{
            foreach ($phones as $p)
            {
                $phoneData = 
                [
                    'id' => $p->id,
                    'contact_id' => $p->contact->id, 'apps' => $p->apps, 
                    'type' => $p->type, 'number' => $p->number
                ];
                array_push($arrayOfPhones, $phoneData);
            }
        }
        return response()->json($arrayOfPhones);
    }
}
