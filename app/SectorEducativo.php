<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectorEducativo extends Model
{
    use ConPines;
    use ConReferencias;

    protected $table = "sector_educativo";

    public function establecimientos_educativos()
    {
        return $this->hasMany('App\EstablecimientoEducativo');
    }
}
