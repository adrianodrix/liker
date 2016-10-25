<?php

namespace Liker\Domains\Users\Database\Seeders;


use Illuminate\Database\Seeder;
use Liker\Domains\Users\Models\User;

class UserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->truncate();
        factory(User::class, 30)->create();
    }
}