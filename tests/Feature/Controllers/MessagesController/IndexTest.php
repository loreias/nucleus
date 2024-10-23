<?php

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('displays all messages of a given conversation', function () {

    $conversation = Conversation::factory()
        ->has(Message::factory()->count(3))
        ->create();

    $response = get(route('messages.index', $conversation->slug));

    $response->assertOk()
        ->assertJsonFragment([
            'title' => $conversation->title,
        ])
        ->assertJsonCount(3, 'data.messages');

    $data = $response->json('data.messages');

    $this->assertEquals(
        $conversation->messages->toArray(),
        $data
    );

});


it('doesnt display messages that does not belong to the conversation', function(){

    $conversation = Conversation::factory()
        ->has(Message::factory()->count(1))
        ->create();

    $otherMessages = Message::factory(2)->create();

    $response = get(route('messages.index', $conversation->slug));

    $response->assertOk()
        ->assertJsonFragment([
            'title' => $conversation->title,
        ])
        ->assertJsonCount(1, 'data.messages')
        ->assertJsonMissing([
            'id' => $otherMessages->first()->id
        ]);

});
