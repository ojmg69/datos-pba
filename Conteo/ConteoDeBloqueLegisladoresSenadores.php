<?php

namespace App\Conteo;

use App\Bloque;
use App\ConcejoDeliberante;
use App\Legisladores;

/**
 * Conteo de la cantidad de concejales por bloque
 */
class ConteoDeBloqueLegisladoresSenadores extends Conteo
{
    /**
     * $args :: [ idSeccion => int ] | null
     */
    protected function cargarDatos($args)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {
            $legisladoresCountQuery = Legisladores::selectRaw("count(*)")
                ->where('legisladores.distrito_id', '=', $args['idMunicipio'])
                ->where('legisladores.tipo', 'like', '%SENADOR%')
                ->whereRaw('legisladores.bloque_leg_id = bloques.id')
                ->getQuery();

            return Bloque::select('bloques.*')
                ->selectSub($legisladoresCountQuery, 'legisladores')
                ->orderBy('legisladores', 'desc')
                ->get();
        } else if ($this->tieneArgumento('idSeccion', $args)) {
            $legisladoresCountQuery = Legisladores::join('distritos', 'legisladores.distrito_id', '=', 'distritos.id')
                ->join('secciones', 'distritos.seccion_id', '=', 'secciones.id')
                ->selectRaw("count(*)")
                ->where('secciones.id', '=', $args['idSeccion'])
                ->where('legisladores.tipo', 'like', '%SENADOR%')
                ->whereRaw('legisladores.bloque_leg_id = bloques.id')
                ->getQuery();

            return Bloque::select('bloques.*')
                ->selectSub($legisladoresCountQuery, 'legisladores')
                ->orderBy('legisladores', 'desc')
                ->get();
        } else {
            return Bloque::leftJoin('legisladores', 'bloques.id', '=', 'legisladores.bloque_leg_id')
                ->selectRaw('count(*) as legisladores, bloques.color, bloques.nombre')
                ->where('legisladores.tipo', 'like', '%SENADOR%')
                ->groupBy('bloques.id')
                ->orderBy('legisladores', 'desc')
                ->get();
        }
    }

    protected function getValorDeCategoria($dato)
    {
        return $dato->legisladores;
    }

    protected function getNombreDeCategoriaRestante()
    {
        return 'Otros bloques';
    }

    protected function getColorDeCategoriaRestante()
    {
        return '#D0B9DB';
    }
}
