<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)
        ->has(Blog::factory(1)
        ->has(
            Comment::factory(3)
        )
        )
        ->create();
        // Blog::factory(10)->create();
        // Category::factory(10)->create();
    }
}
