<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $connection = 'core';
    protected $table = 'rol';
    protected $primaryKey ='id';
}
