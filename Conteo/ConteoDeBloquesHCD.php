<?php

namespace App\Conteo;

use App\Bloque;
use App\ConcejoDeliberante;

/**
 * Conteo de la cantidad de concejales por bloque
 */
class ConteoDeBloquesHCD extends Conteo
{
    /**
     * $args :: [ idSeccion => int ] | null
     */
    protected function cargarDatos($args)
    {
        if ($this->tieneArgumento('idMunicipio', $args))
        {
            $concejalesCountQuery = ConcejoDeliberante::
                selectRaw("count(*)")
                ->where('concejo_deliberantes.distrito_id', '=', $args['idMunicipio'])
                ->whereRaw('concejo_deliberantes.bloque_id = bloques.id')
                ->getQuery();

            return Bloque::
                select('bloques.*')
                ->selectSub($concejalesCountQuery, 'concejales')
                ->orderBy('concejales', 'desc')
                ->get();
        } else if ($this->tieneArgumento('idSeccion', $args))
        {
            $concejalesCountQuery = ConcejoDeliberante::
                join('distritos', 'concejo_deliberantes.distrito_id', '=', 'distritos.id')
                ->join('secciones', 'distritos.seccion_id', '=', 'secciones.id')
                ->selectRaw("count(*)")
                ->where('secciones.id', '=', $args['idSeccion'])
                ->whereRaw('concejo_deliberantes.bloque_id = bloques.id')
                ->getQuery();

            return Bloque::
                select('bloques.*')
                ->selectSub($concejalesCountQuery, 'concejales')
                ->orderBy('concejales', 'desc')
                ->get();
        } else
        {
            return Bloque::
                leftJoin('concejo_deliberantes', 'bloques.id', '=', 'concejo_deliberantes.bloque_id')
                ->selectRaw('count(*) as concejales, bloques.color, bloques.nombre')
                ->groupBy('bloques.id')
                ->orderBy('concejales', 'desc')
                ->get();
        }
    }

    protected function getValorDeCategoria($dato)
    {
        return $dato->concejales;
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