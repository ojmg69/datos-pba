<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServicioConectividad extends Model
{
    protected $table = "servicio_conectividad";
    
    public function distrito() {
        return $this->belongsTo('App\Distrito');
    }
}