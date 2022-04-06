<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legisladores extends Model
{
    protected $table = "legisladores";

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }

    public function bloque()
    {
        return $this->belongsTo('App\BloqueLegislativos');
    }
}
