<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $connection = 'core';
    protected $table = 'vehiculo';
    protected $primaryKey ='id';
    protected $fillable =['id',
        'id_importador',
        'chasis',
        'marca',
        'modelo',
        'color',
        'tipo_auto',
        'observacion',
        'descripcion',
        'status','created_by','updated_by'];


    public function getEnum($tipo=""){
        $aData = [
                'NEUMATICO' => "Neumatico",
                'PUERTA' => "Puerta",
                'VENTANA' => "Ventana",
            ];
        if($tipo==""){
            return $aData;
        }
        return $aData[$tipo];
    }

}
