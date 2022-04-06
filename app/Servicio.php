<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = "servicios";

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }
}
