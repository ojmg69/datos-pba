<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viento extends Model
{
    protected $table = "vientos";

    public function distritos()
    {
        return $this->belongsToMany('App\Distrito')->withTimestamps();
    }

}
