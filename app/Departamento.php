<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = "departamentos";

    public function distritos()
    {
        return $this->hasMany('App\Distrito');
    }

    public static function referenciasPorColor() {
        $resultado = [];
        $deptos = Departamento::all();
        foreach ($deptos as $depto) {
            $ref = [
                'nombre'    => $depto->nombre,
                'relleno'   => $depto->color
            ];
            array_push($resultado, $ref);
        }
        return $resultado;
    }
}
