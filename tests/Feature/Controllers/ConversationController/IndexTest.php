<?php

use App\Models\User;
use App\Models\Conversation;
use function Pest\Laravel\get;
use Illuminate\Foundation\Testing\RefreshDatabase;

// thanks for the tip...
uses(RefreshDatabase::class);

it('list all the conversations that im include on', function () {

    //arrange
    $me = User::factory()->create();

    $myConversations = Conversation::factory(3)
        ->hasAttached($me)
        ->hasAttached(User::factory()->count(2))
        ->create();

    //act - assert
    $response = get(route('conversation.index'));

    //macro here...
    $data = $response->json()['data'];

    $response
        ->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonFragment([
            'title' => $myConversations->first()->title
        ]);

    $this->assertEquals(
        $myConversations->pluck('slug')->toArray(),
        array_keys($data)
    );
});


it('doesnt list other  users projects', function () {

    $me = User::factory()->create();

    Conversation::factory(3)
        ->hasAttached($me)
        ->hasAttached(User::factory()->count(2))
        ->create();

    // other conversations
    $otherConversation = Conversation::factory(1)
        ->hasAttached(User::factory()->count(2))
        ->create([
            'title' => 'other conversation'
        ]);


    //act - assert
    $response = get(route('conversation.index'));

    $response
        ->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonMissing(
            $otherConversation->keyBy('slug')->toArray()
        );
});
