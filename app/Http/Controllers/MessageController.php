<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getChat(Request $request)
    {

        $chat = Message::paginate(15);


        return [
            'chat' => $chat
        ];

    }

    public function createMessage(MessageRequest $request){

    }
}
