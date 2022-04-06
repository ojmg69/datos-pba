<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    protected $table = "paises";

    public function consulados()
    {
        return $this->hasMany('App\Consulado');
    }
}
