<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspacioContencion extends Model
{
    use ConPines;

    protected $table = "espacios_contencion";

    public function distrito() {
        return $this->belongsTo('App\Distrito');
    }
}
