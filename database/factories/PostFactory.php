<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=> $this->faker->sentence(2),
            'slug'=> $this->faker->unique()->slug(),
            'excerpt'=> $this->faker->text(100),
            'content'=> $this->faker->paragraph,
            'user_id'=>1,
            'category_id' => Category::all()->random()->id,
            'is_published'=> true,
            'published_at'=> now(),

        ];
    }
}
