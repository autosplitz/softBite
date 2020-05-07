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
        $user = App\User::create([
            'name' => 'Khalid Adegoke',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Admin@123')
        ]);

        $user->restaurants()->create([
            'name' => 'Mr. Chef',
            'location' => 'Chef street, Akerele'
        ]);

        $user->restaurants()->create([
            'name' => 'Bite House',
            'location' => 'Bite street, Smith Avenue'
        ]);

        $user->restaurants()->create([
            'name' => 'Blazers Pot',
            'location' => 'Blazers street, Ogunlana Drive'
        ]);

        $user->restaurants()->create([
            'name' => 'Tasty Chicken',
            'location' => '13, Smith street, Surulere'
        ]);
    }
}
