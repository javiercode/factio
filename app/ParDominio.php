<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParDominio extends Model
{
    protected $connection = 'core';
    protected $table = 'par_dominio';
    protected $primaryKey ='id';

    protected $fillable =['id','codigo','dominio','detalle','descripcion','estado','status','created_by','updated_by'];
}
