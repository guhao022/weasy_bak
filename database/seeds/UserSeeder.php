<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'     => 'admin',
            'password' => Hash::make('admin'),
            'email'    => 'admin@weasy.com',
            'is_admin' => 1,
        ]);
    }
}