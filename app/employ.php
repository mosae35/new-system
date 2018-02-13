<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employ extends Model
{
    protected $fillable = ['name','address','telephone','mobile','number','place','user_id'];
}
