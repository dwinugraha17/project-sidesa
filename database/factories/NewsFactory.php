<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => fake()->paragraphs(3, true),
            'image' => 'https://source.unsplash.com/random/800x600/?village,nature',
            'user_id' => 1, // Asumsi user ID 1 ada (Admin)
            'is_published' => true,
        ];
    }
}