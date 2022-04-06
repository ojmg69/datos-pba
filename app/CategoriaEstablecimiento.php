<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaEstablecimiento extends Model
{
    use ConReferencias;
    
    protected $table = "categorias_establecimientos";

    public function establecimientos()
    {
        return $this->hasMany('App\EstablecimientoSanitario');
    }
}
