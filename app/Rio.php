<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rio extends Model
{
    protected $table = "rios";

    public function distritos()
    {
        return $this->belongsToMany('App\Distrito')->withTimestamps();
    }
}
