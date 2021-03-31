<?php

namespace App\Repositories;

use App\Message;

class MessageRepository implements MessageRepositoryInterface
{
    public function display()
    {
        // $messages = Message::all();
        // if ($messages) {
        //     return response()-> json([
        //         'data'=> $messages
        //     ], 200);
        // }
        // return response()->json([
        //     'message' => 'empty',
        // ], 404);
        return $messages = Message::all();
    }
 
    public function view($id)
    {
        $message= Message::find($id);
        if ($message) {
            return response()->json([
                'data'=>$message
            ], 200);
        }
        return response()->json([
            'message' => 'message could not be found'
        ], 500);
    }
 
    public function create($request)
    {
        $message = new Message();
        $message -> fill($request->all());
        if ($message->save()) {
            return response()->json([
                'message' => 'message sent successfully',
                'data' => $message
            ], 200);
        }
        return response()->json([
            'message' => 'message could not be added'
        ], 500);
    }
    
    public function delete($id)
    {
        $message= Message::find($id);
        if ($message->delete()) {
            return response()->json([
                'message'=>'this message got deleted'
            ], 200);
        }
        return response()->json([
            'message' => 'message could not be deleted'
        ], 500);
    }
}