<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanPolitico extends Model
{
    protected $table = "planes_politicos";

    public function distritos()
    {
        return $this->belongsToMany('App\Distrito')->withTimestamps();
    }
}
