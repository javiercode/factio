<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $connection = 'core';
    protected $table = 'person';
    protected $primaryKey ='id';
    protected $fillable = [
        'id','first_name','second_name','first_lastname','second_lastname','ci','gender', 'created_by', 'updated_by'
    ];
}
