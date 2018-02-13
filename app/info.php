<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class info extends Model
{
    protected $fillable = ['process','type','size','num','cic','process_id'];
    protected $table = 'info';

    public function processs(){
        return $this->belongsTo('App\process');
    }
}
