<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenca extends Model
{
    protected $table = "cuencas";

    public function distritos()
    {
        return $this->belongsToMany('App\Distrito');
    }
}
