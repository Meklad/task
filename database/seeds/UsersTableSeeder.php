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
            'name' => 'Super Editor',
            'email' => 'super.editor@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
