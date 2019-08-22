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
                $messageData = 
                [
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = new Message;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->contact_id = $request->contact_id;
        $message->save();
        return Response()->json($message, 201);
    }    
    

    public function show($id)
    {
        $message = Message::find($id);
        if(isset($message))
        {
            // $data = $message;
            //{"id":60,"subject":"Assunto Teste 2 para contato 2","message":"Aqui Vai minha mensagem #2 para o contato id 2","contact_id":2,"created_at":null,"updated_at":null}
            $data = [
                "id" => $message->id,
                "contact_full_name" => $message->contact->fname . ' ' . $message->contact->lname,
                "contact_email" => $message->contact->email,
                "subject" => $message->subject,
                "message" => $message->message,
                "contact_id" => $message->contact_id,
                "created_at" => $message->created_at,
                "updated_at" => $message->updated_at
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Message::where('id', $id)->exists()){
            $message = Message::find($id);
            $message->subject = is_null($message->subject) ? $message->subject : $request->subject;
            $message->message = is_null($message->message) ? $message->message : $request->message;
            $message->contact_id = is_null($message->contact_id) ? $message->contact_id : $request->contact_id;
            $message->save();
            $data =
                [ 
                    'status' => '200', 'callback_message' => 'Updated!',
                    'action' => 'update', 'target' =>  $id
                ];
            return Response()->json($data, 200);
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
