<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'content' => $this->faker->paragraph(),
            'image_url' => $this->faker->optional()->imageUrl(640, 480),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}