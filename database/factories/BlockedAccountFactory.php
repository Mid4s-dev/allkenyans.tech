<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlockedAccountFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'x_account_id' => fake()->unique()->numerify('##########'),
            'username' => fake()->userName(),
            'category' => fake()->randomElement(['porn', 'hate_speech', 'propaganda', 'scam', 'other']),
            'reason' => fake()->sentence(),
        ];
    }
}
