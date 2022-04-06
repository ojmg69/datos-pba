<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEleccion extends Model
{
    protected $table = "tipos_elecciones";

    public function elecciones()
    {
        return $this->hasMany('App\Eleccion');
    }
}
