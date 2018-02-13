<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employeeAbcent extends Model
{
    protected $fillable =['day','month','year','employee_id'];
    protected $table = 'employee_abcents';
}
