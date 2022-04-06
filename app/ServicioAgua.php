<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServicioAgua extends Model
{
    protected $table = "servicio_agua";
    
    public function distrito() {
        return $this->belongsTo('App\Distrito');
    }
}