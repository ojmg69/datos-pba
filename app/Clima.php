<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clima extends Model
{
    protected $table = "climas";

    public function distritos()
    {
        return $this->belongsToMany('App\Distrito');
    }


    public static function nombreClimaSegunDistrito($idDistrito){

        $climas = Clima::join('clima_distrito', 'climas.id', '=', 'clima_distrito.clima_id')
        ->join('distritos', 'clima_distrito.distrito_id', '=', 'distritos.id')
        ->select('climas.*', 'climas.nombre as nombre')
        ->where('clima_distrito.distrito_id', '=', $idDistrito)
        ->get();
        $nombres = [];
        foreach ($climas as $clima) {
            $nombre = $clima->nombre;
            array_push($nombres, $nombre);
        }
        return $nombres;
    }
}
