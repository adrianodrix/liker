<?php

namespace Liker\Domains\Posts\Database\Seeders;

use Illuminate\Database\Seeder;
use Liker\Domains\Posts\Models\Post;
use Liker\Domains\Users\Models\User;

class PostTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('posts')->truncate();
        foreach (User::all() as $user) {
            factory(Post::class, 3)
                ->create(['user_id' => $user->id]);
        }
    }
}