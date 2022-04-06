<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Discapacitado extends Model
{
    use ConPines;

    protected $table = "discapacitados";

    public function distrito() {
        return $this->belongsTo('App\Distrito');
    }

    public function sector_educativo() {
        return $this->belongsTo('App\SectorEducativo');
    }
}
