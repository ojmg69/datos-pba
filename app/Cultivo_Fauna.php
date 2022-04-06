<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cultivo_Fauna extends Model
{
    protected $table = "cultivos_fauna";

    public function distritos()
    {
        return $this->belongsToMany('App\Distrito')->withTimestamps();
    }
}
