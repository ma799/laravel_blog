<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
     $i=1;
     Category::factory(7)->create();
     Tag::factory(6)->create();
     Post::factory(8)->create();
     foreach (Post::all() as $post) {
        $post->image = 'posts/bg/'.$i++.'.jpg';
        $post->tags()->attach([Tag::all()->random()->id,Tag::all()->random()->id]);
     }
    }
}
