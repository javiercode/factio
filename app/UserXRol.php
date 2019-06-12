<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserXRol extends Model
{
    protected $connection = 'core';
    protected $table = 'user_x_rol';
    protected $primaryKey ='id';

    protected $fillable =['id','id_user','id_rol','status','created_by','updated_by'];
}
