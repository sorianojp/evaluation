<?php

use Illuminate\Database\Seeder;
use App\User;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'Administrator',
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('password')
        ]);

        $user->assignRole('Admin');
    }
}
