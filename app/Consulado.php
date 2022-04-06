<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulado extends Model
{
    protected $table = "consulados";


    public function pais()
    {
        return $this->belongsTo('App\Paises');
    }

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }
}
