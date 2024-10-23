<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversation>
 */
class ConversationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name;

        return [
            'title' => fake()->realText(),
            'name'  => $name,
            'slug'  => \Str::of($name)->slug('_')->value(),
        ];
    }

//    public function withUser(int $userCount=3)
//    {
//        return $this->afterCreating(function ($conversation) use ($userCount) {
//            $conversation->users()->attach($user);
//        });
//    }
}
