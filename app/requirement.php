<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class requirement extends Model
{
   protected $fillable = ['name','num','user_id'];
}
