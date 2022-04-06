<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZonaHidrica extends Model
{
    protected $table = "zona_hidricas";

    public function distritos()
    {
        return $this->belongsToMany('App\Distrito')->withTimestamps();
    }
}
