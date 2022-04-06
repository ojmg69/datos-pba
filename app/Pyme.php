<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pyme extends Model
{
    protected $table = "pymes";

    public function distrito() {
        return $this->belongsTo('App\Distrito');
    }

    public function agrupamientoIndustrial() {
        return $this->belongsTo('App\AgrupamientoIndustrial');
    }
}
