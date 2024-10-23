<?php

namespace App\Http\Controllers;

use App\Models\User;

class ConversationController extends Controller
{
    public function index()
    {

        $user = User::with('conversations')->first();

        return response()->json([
            'data' => $user->conversations->keyBy('slug')
        ]);
    }
}
