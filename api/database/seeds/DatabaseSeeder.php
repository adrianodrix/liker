<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Liker\Domains\Users\Database\Seeders\UserTableSeeder::class);
        $this->call(Liker\Domains\Posts\Database\Seeders\PostTableSeeder::class);
    }
}
