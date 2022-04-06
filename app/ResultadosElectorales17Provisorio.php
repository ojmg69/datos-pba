<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadosElectorales17Provisorio extends Model
{
    protected $table = "resultados_electorales_provisorios";

    public function tipoElecction()
    {
        return $this->belongsTo('App\TipoEleccion');
    }

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }
}
