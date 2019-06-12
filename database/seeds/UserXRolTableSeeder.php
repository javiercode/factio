<?php

use Illuminate\Database\Seeder;

class UserXRolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_x_rol')->insert([
            'id_user' => '1',
            'id_rol' => '1',
        ]);
        DB::table('user_x_rol')->insert([
            'id_user' => '2',
            'id_rol' => '2',
        ]);
        DB::table('user_x_rol')->insert([
            'id_user' => '3',
            'id_rol' => '3',
        ]);
    }
}
