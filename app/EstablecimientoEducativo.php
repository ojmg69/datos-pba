<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstablecimientoEducativo extends Model
{
    use ConPines;

    protected $table = "establecimientos_educativos";

    public function distrito() {
        return $this->belongsTo('App\Distrito');
    }

    public function sector_educativo() {
        return $this->belongsTo('App\SectorEducativo');
    }
}
