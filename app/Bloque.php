<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloque extends Model
{
    protected $table = 'bloques';

    protected $fillable = [
        'color'
    ];

    public function concejales()
    {
        return $this->hasMany('App\ConcejoDeliberante');
    }
    
    public function legisladores()
    {
        return $this->hasMany('App\Legisladores');
    }

    public static function referencias() {
        $resultado = [];

        $bloques = Bloque::orderBy('color')->get();

        foreach ($bloques as $bloque) {
            array_push($resultado, [
                'nombre'    => $bloque->nombre,
                'relleno'   => $bloque->color
            ]);
        }

        return $resultado;
    }
}
