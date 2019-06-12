<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $connection = 'core';
    protected $table = 'sensor';
    protected $primaryKey ='id';

    protected $fillable = [
        'id','id_central','codigo','','detalle','tipo','descripcion','status', 'created_by', 'updated_by'
    ];

    public function getEnum($tipo=""){
        $aData = [
            'MQ7' => "MQ7",
            'MQ5' => "MQ5",
            'MQ135' => "MQ135",
        ];
        if($tipo==""){
            return $aData;
        }
        return $aData[$tipo];
    }
}
