<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SensorDato extends Model
{
    protected $connection = 'core';
    protected $table = 'sensor_dato';
    protected $primaryKey ='id';
    protected $fillable =['id','id_sensor','valor','tipo','descripcion','fecha','estado','status','created_by','updated_by'];

    const TIPO_ALERTA = 'TIPO_ALERTA';
    const ENCENDIDO = 'ENCENDIDO';
    const APAGADO = 'APAGADO';
    const ATENDIDO = 'ATENDIDO';

    public function getEnumTipo($tipo=""){
        $aData = [
            'ENCENDIDO' => "Neumatico",
            'APAGADO' => "Puerta",
            'ATENDIDO' => "Ventana",

        ];
        if($tipo==""){
            return $aData;
        }
        return $aData[$tipo];
    }

    //
}
