<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Central extends Model
{
    protected $connection = 'core';
    protected $table = 'central';
    protected $primaryKey ='id';

    protected $fillable = [
        'id','nombre','tipo','descripcion','ubicacion','latitud','longitud', 'created_by', 'updated_by'
    ];
}