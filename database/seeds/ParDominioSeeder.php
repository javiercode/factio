<?php

use Illuminate\Database\Seeder;

class ParDominioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('par_dominio')->insert([
            'codigo' => 'ALERTA_MEDICA',
            'dominio' => 'TIPO_ALERTA',
            'detalle' => 'Alerta Medica',
            'tipo' => 'alerta',
            'descripcion' => '',
            'created_by' => '1',
        ]);
        DB::table('par_dominio')->insert([
            'codigo' => 'FUEGO',
            'dominio' => 'TIPO_ALERTA',
            'detalle' => 'Fuego',
            'tipo' => 'alerta',
            'descripcion' => '',
            'created_by' => '1',
        ]);
        DB::table('par_dominio')->insert([
            'codigo' => 'ALERTA_POLICIAL',
            'dominio' => 'TIPO_ALERTA',
            'detalle' => 'Alerta Policial',
            'tipo' => 'alerta',
            'descripcion' => '',
            'created_by' => '1',
        ]);
        DB::table('par_dominio')->insert([
            'codigo' => 'MENSAJE_PREGRABADO',
            'dominio' => 'TIPO_ALERTA',
            'detalle' => 'Mensaje Pregrabado',
            'tipo' => 'alerta',
            'descripcion' => '',
            'created_by' => '1',
        ]);
        DB::table('par_dominio')->insert([
            'codigo' => 'LLAMADA',
            'dominio' => 'TIPO_ALERTA',
            'detalle' => 'Llamada',
            'tipo' => 'alerta',
            'descripcion' => '',
            'created_by' => '1',
        ]);
    }
}
