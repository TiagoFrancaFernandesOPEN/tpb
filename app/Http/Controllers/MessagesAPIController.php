<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use App\Phone;
use App\Message;

class MessagesAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->listMessages();
    }
public function listMessages()
    {
        $collections = Message::all();
        $result = (int) $collections->count();
        $arrayOfMessages = array();
        $messages = $collections;
        if($result <= 0 ){
            $arrayOfMessages = ['error' => 'You have no messages.'];
        }else{
            $arrayOfMessages = array();
            foreach ($messages as $m)
            {
                $messageData = [
                     'id' => $m->id,
                    'toId' => $m->contact->id, 'toName' => $m->contact->fname, 
                    'subject' => $m->subject, 'message' => $m->message
                ];
                array_push($arrayOfMessages, $messageData);
            }
        }
        return response()->json($arrayOfMessages);
    }

    public function messagesByContact($id)
    {
        $collections = Message::where('contact_id', $id);
        $result = (int) $collections->count();
        $messages = $collections->get();
        $arrayOfMessages = array();
        
        if($result <= 0 ){
            $arrayOfMessages = ['error' => 'You have no messages.'];
        }else{
            foreach ($messages as $m)
            {
                $messageData = [
                     'id' => $m->id,
                    'toId' => $m->contact->id, 'toName' => $m->contact->fname, 
                    'subject' => $m->subject, 'message' => $m->message
                ];
                array_push($arrayOfMessages, $messageData);
            }
        }
        return response()->json($arrayOfMessages);
    }

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
        $message = Message::find($id);
        if(isset($message))
        {            
            $data = $message;
            return Response()->json($data, 202);
        }
            $data =
            [
                'status' => '404', 'callback_message' => 'Not found!',
                'action' => 'show', 'target' =>  $id
            ];
            return Response()->json($data, 404);
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
        $message = Message::find($id);
        if(isset($message))
        {
            if($message->delete())
            {
                $data =
                [ 
                    'status' => '202', 'callback_message' => 'Deleted!',
                    'action' => 'delete', 'target' =>  $id
                ];
                return Response()->json($data, 202);
            }
        }
                $data =
                [
                    'status' => '404', 'callback_message' => 'Not found!',
                    'action' => 'delete', 'target' =>  $id
                ];
                return Response()->json($data, 404);
    }
}
