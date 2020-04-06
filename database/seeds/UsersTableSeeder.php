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
        App\User::create([
            'name' => 'Khalid Adegoke',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Admin@123')
        ]);
    }
}
