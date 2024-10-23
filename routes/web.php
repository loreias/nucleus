<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\ConversationController;

route::get('conversations', [ConversationController::class, 'index'] )
    ->name('conversation.index');

route::get('conversations/{conversation:slug}/messages', [MessagesController::class, 'index'] )
    ->name('messages.index');
