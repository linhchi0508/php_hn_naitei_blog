<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['id' => 1, 'username' => 'admin', 'email' => 'admin@gmail.com', 'password' => bcrypt('12345678'), 'status' => 1, 'roles_id' => 2],
            ['id' => 2, 'username' => 'inspector', 'email' => 'inspector@gmail.com', 'password' => bcrypt('12345678'), 'status' => 1, 'roles_id' => 3],
            ['id' => 3, 'username' => 'user1', 'email' => 'user1@gmail.com', 'password' => bcrypt('12345678'), 'status' => 1, 'roles_id' => 1],
            ['id' => 4, 'username' => 'user2', 'email' => 'user2@gmail.com', 'password' => bcrypt('12345678'), 'status' => 1, 'roles_id' => 1],
            ['id' => 5, 'username' => 'user3', 'email' => 'user3@gmail.com', 'password' => bcrypt('12345678'), 'status' => 1, 'roles_id' => 1],
        ]);
    }
}
