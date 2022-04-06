<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CircuitosElectorales extends Model
{
    protected $table = "circuitos_electorales";

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }
    
}
