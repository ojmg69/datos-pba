<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstablecimientoSanitario extends Model
{
    use ConPines;
    
    protected $table = "establecimientos_sanitarios";

    public function categoria()
    {
        return $this->belongsTo('App\CategoriaEstablecimiento');
    }

    public function tipo()
    {
        return $this->belongsTo('App\TipoEstablecimiento');
    }

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }
}
