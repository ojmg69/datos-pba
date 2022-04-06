<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $table = 'partidos';

    public function distritos()
    {
        return $this->hasMany('App\Distrito');
    }

    public function intendentes()
    {
        return $this->hasMany('App\Intendente');
    }

    public function consulados()
    {
        return $this->hasMany('App\Consulado');
    }
}
