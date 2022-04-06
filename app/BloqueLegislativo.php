<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloqueLegislativo extends Model
{
    protected $table = "bloques_legislativos";

    public function legisladores()
    {
        return $this->hasMany('App\Legisladores');
    }
}
