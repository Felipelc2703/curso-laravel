<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Post::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // $categoria = Category::inRandomOrder()->first();

        for($i = 0; $i < 20; $i++)
        {
            $categoria = Category::inRandomOrder()->first();

            $title = Str::random("25");
            Post::create(
                [
                    'title' => $title,
                    'slug' => Str::slug($title),
                    'description' => "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, quis at velit officiis sit laborum omnis. Laudantium aut illum accusantium expedita? Praesentium velit id temporibus blanditiis, exercitationem obcaecati voluptate atque.</p>",
                    'content' => "<p>Lorem ipsum dolor sit amet consectetur </p>",
                    'category_id' => $categoria->id,
                    'posted' => 'yes'
                ]
                );
        }
    }
}
