<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organo extends Model
{
    protected $table = "organos";

    public function sedes() {
        return $this->hasMany('App\Sede');
    }
}
