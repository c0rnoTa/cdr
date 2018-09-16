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
        DB::table('users')->insert([
            'name' => 'Demo User',
            'login' => 'demo',
            'email' => 'demo@exmple.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
