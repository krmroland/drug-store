<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //create a default admin
        User::create([
            'email'=>'admin@drugs.com',
            'password'=>bcrypt('secret'),
            'name'=>'Administrator',
        ]);
    }
}
