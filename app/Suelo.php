<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suelo extends Model
{
    protected $table = "suelos";

    public function distritos()
    {
        return $this->belongsToMany('App\Distrito')->withTimestamps();
    }

}
