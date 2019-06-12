<?php

use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rol')->insert([
            'code' => 'SUP',
            'name' => 'Superusuario',
            'description' => 'Superusuario',
        ]);
        DB::table('rol')->insert([
            'code' => 'ADM',
            'name' => 'Administrador',
            'description' => 'Administrador',
        ]);
        DB::table('rol')->insert([
            'code' => 'CLI',
            'name' => 'Cliente',
            'description' => 'Usuario del sistema',
        ]);
    }
}
