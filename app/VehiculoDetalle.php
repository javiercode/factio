<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehiculoDetalle extends Model
{
    protected $connection = 'core';
    protected $table = 'vehiculo_detalle';
    protected $primaryKey ='id';
    protected $fillable =['id',
        'id_vehiculo',
        'detalle',
        'tipo',
        'descripcion',
        'status','created_by','updated_by'];
}
