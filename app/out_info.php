<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class out_info extends Model
{
    protected $fillable = ['process','type','size','num','cic','process_id'];
    protected $table = 'out_infos';
}
