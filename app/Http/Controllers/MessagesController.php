<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(Conversation $conversation)
    {
        return response()->json([
            'data' => [
                'conversation' => $conversation,
                'messages'     => $conversation->messages
            ]
        ]);
    }
}
