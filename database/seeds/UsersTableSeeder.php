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
            'name' => 'Bety Condori',
            'username' => 'bcondori',
            'email' => 'bety@mail.com',
            'password' => bcrypt('123456'),
            'created_by' => '1',
        ]);
        DB::table('users')->insert([
            'name' => 'Wilfredo',
            'username' => 'wilfredo',
            'email' => 'wilfredo@mail.com',
            'password' => bcrypt('123456'),
            'created_by' => '1',
        ]);
        DB::table('users')->insert([
            'name' => 'Pablo Escobar',
            'username' => 'pescobar',
            'email' => 'pescobar@mail.com',
            'password' => bcrypt('123456'),
            'created_by' => '1',
        ]);
    }
}
