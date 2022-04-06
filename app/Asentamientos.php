<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asentamientos extends Model
{
    protected $table = "asentamientos";

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }

    public function tipo_asentamientos()
    {
        return $this->belongsTo('App\TipoAsentamientos');
    }
    
    public static function pines() {
        $resultado = [];

        $asentamientos = Asentamientos::all();

        foreach ($asentamientos as $asentamiento) {
            $pin = [
                'latitud' => $asentamiento->latitud,
                'longitud' => $asentamiento->longitud,
                'relleno' => '#f00',
            ];
            array_push($resultado, $pin);
        }

        return $resultado;
    }
}
