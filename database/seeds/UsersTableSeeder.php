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
        User::create([
            'name' => 'Sektiawan',
            'email' => 'sektia7@gmail.com',
            'password' => bcrypt('secret')
        ]);
    }
}
