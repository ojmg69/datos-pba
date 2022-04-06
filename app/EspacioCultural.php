<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspacioCultural extends Model
{
    use ConPines;

    protected $table = "espacio_cultural";

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }
}
