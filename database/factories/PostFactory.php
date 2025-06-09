<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    
    public function definition(): array
    {
        $randImg = rand(1,14);
        return [
            'title' => fake()->catchPhrase(),
            'description' => fake()->sentence(10), 
             'content' => fake()->sentence(20),
             'image' => 'posts/bg/'.$randImg.'.jpg',
             'category_id' => Category::all()->random()->id,
             'user_id' => User::all()->random()->id,
             'published_at' => now(),
        ];
    }
}
