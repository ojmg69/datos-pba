<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEstablecimiento extends Model
{
    protected $table = "tipos_establecimientos";

    public function establecimientos()
    {
        return $this->hasMany('App\EstablecimientoSanitario');
    }
}
