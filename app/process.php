<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class process extends Model
{
    protected $fillable = ['doctor','name','type','client','place','num_slim','num_pin','cash','not_cash','created_at'];
    protected $table = 'processes';

    public function infos(){
        return $this->hasMany('App\info');
    }

}
