<?php

use App\Models\User;
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
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin123456'),
            'user_role' => 159,
            'user_status' => 1
        ]);
    }
}
