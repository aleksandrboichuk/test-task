<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::query()->create([
            'name' => "First Post",
            'slug' => fake()->slug(2),
            'content' => fake()->text(),
            'created_by' => 1,
        ]);
    }
}
