<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class out_used extends Model
{
    protected $fillable = ['process','type','size','num','cic','process_id'];
}
