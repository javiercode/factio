<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $connection = 'core';
    protected $table = 'asignacion';
    protected $primaryKey ='id';
    protected $fillable =['id',
        'id_sensor',
        'id_entrada',
        'id_salida',
        'id_vehiculo',
        'estado',
        'detalle',
        'observacion',
        'status','created_by','updated_by'];

    const ABIERTO = 'ABIERTO';
    const CERRADO = 'CERRADO';
    const ASIGNADO = 'ASIGNADO';
}
