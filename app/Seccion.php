<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Seccion extends Model
{
    
    protected $table = 'secciones';

    public function distritos()
    {
        return $this->hasMany('App\Distritos');
    }

    public static function estilosSegunPartidos() {
        $resultado = [];

        $secciones = Seccion::all();

        foreach ($secciones as $seccion) {
            $partido = Seccion::partidoConMasMunicipios($seccion->id);
            if (!is_null($partido)) {
                $estilo = [
                    'id'        => $seccion->id,
                    'relleno'   => $partido->color
                ];
                array_push($resultado, $estilo);
            }
        }
        return $resultado;
    }

    /**
     * Devuelve el partido con mayor cantidad de municipios dentro
     * de una seccion. Si dos o mas partidos tienen la misma cantidad
     * de municipios, devuelve null.
     */
    private static function partidoConMasMunicipios($seccionId) {
        $consulta = Partido::
            rightJoin('intendentes', 'intendentes.partido_id', '=', 'partidos.id')
            ->leftJoin('distritos', 'intendentes.distrito_id', '=', 'distritos.id')
            ->leftJoin('secciones', 'distritos.seccion_id', '=', 'secciones.id')
            ->select('partidos.*', Db::raw('count(partidos.id) as municipios'))
            ->where('secciones.id', '=', $seccionId)
            ->orderBy(DB::raw('count(partidos.id)'), 'DESC')
            ->groupBy('partidos.id')
            ->take(2);
        
        $partidos = $consulta->get();

        if (count($partidos) > 1) {
            return $partidos[0]->municipios > $partidos[1]->municipios
                ? $partidos[0]
                : null;
        } else {
            return $partidos[0];
        }
    }
}
