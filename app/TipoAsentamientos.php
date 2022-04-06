<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoAsentamientos extends Model
{
    protected $table = "tipo_asentamientos";

    public function asentamientos()
    {
        return $this->hasMany('App\Asentamientos');
    }
}
