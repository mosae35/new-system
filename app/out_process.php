<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class out_process extends Model
{
    protected $fillable = ['doctor','name','type','client','place','cash','in_cash','user_id','created_at'];

}
