<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use ConPines;
    
    protected $table = "sedes";

    public function organo() {
        return $this->hasOne('App\Organo');
    }

    public function departamento() {
        return $this->hasOne('App\Departamento');
    }

    public static function pines() {
        $resultado = [];

        $sedes = Sede::all();

        foreach ($sedes as $sede) {
            $pin = [
                'latitud' => $sede->latitud,
                'longitud' => $sede->longitud,
                'relleno' => '#f00',
            ];
            array_push($resultado, $pin);
        }

        return $resultado;
    }
}
