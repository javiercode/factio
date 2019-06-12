<?php

use Illuminate\Database\Seeder;

class SensorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sensor')->insert([
            'codigo' => 'S1',
            'detalle' => 'Parqueo 1',
            'tipo' => 'ultrasonico',
            'descripcion' => '',
            'created_by' => '1',
        ]);

        DB::table('sensor')->insert([
            'codigo' => 'S2',
            'detalle' => 'Parqueo 2',
            'tipo' => 'ultrasonico',
            'descripcion' => '',
            'created_by' => '1',
        ]);
        DB::table('sensor')->insert([
            'codigo' => 'S3',
            'detalle' => 'Parqueo 3',
            'tipo' => 'ultrasonico',
            'descripcion' => '',
            'created_by' => '1',
        ]);
    }
}
