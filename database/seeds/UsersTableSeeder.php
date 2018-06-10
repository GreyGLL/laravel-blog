<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $user = new User;
        $user->name = 'Grey';
        $user->email = 'GreyGLL7@gmail.com';
        $user->password = bcrypt('kymo');
        $user->save();
    }
}
