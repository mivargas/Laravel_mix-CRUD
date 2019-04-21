<?php

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
        App\User::create(
        	['name' => 'Miguel Vargas',
        	 'email' => 'miguelvargas619@gmail.com',
        	 'password' => Hash::make('12345678')


    ]);
    }
}
