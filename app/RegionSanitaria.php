<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionSanitaria extends Model
{
    protected $table = "regiones_sanitarias";

    public function distritos()
    {
        return $this->belongsToMany('App\Distrito','distrito_reg_sanitarias')
        ->withTimestamps();
    }
}
