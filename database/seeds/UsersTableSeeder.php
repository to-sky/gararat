<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'administrator',
            'email' => 'albugs@gmail.com',
            'password' => bcrypt('&4j0Cgm&'),
            'user_role' => 159,
            'user_status' => 1
        ]);
    }
}
