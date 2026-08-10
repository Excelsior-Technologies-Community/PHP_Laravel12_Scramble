<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::factory()
            ->count(5)
            ->create();

        Post::factory()
            ->count(20)
            ->recycle($categories)
            ->create();
    }
}
