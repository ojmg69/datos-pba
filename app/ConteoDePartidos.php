<?php

namespace App;

/**
 * Representa un conteo de la cantidad de intendentes de cada partido, ordenado de mayor a menor.
 */
class ConteoDePartidos extends Conteo
{
    /**
     * $args :: [ idSeccion => int ] | null
     */
    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idSeccion', $args))
        {
            $intendentesCountQuery = Intendente::
                join('distritos', 'intendentes.distrito_id', '=', 'distritos.id')
                ->join('secciones', 'distritos.seccion_id', '=', 'secciones.id')
                ->selectRaw("count(*)")
                ->where('secciones.id', '=', $args['idSeccion'])
                ->whereRaw('intendentes.partido_id = partidos.id')
                ->getQuery();

            return Partido::
                select('partidos.*')
                ->selectSub($intendentesCountQuery, 'intendentes_count')
                ->orderBy('intendentes_count', 'desc')
                ->get();
        } else
        {
            return Partido::
                withCount('intendentes')
                ->orderBy('intendentes_count', 'desc')
                ->get();
        }
    }

    protected function getValorDeCategoria($dato)
    {
        return $dato->intendentes_count;
    }

    protected function getNombreDeCategoriaRestante()
    {
        return 'Partidos Vecinales';
    }

    protected function getColorDeCategoriaRestante()
    {
        return '#3E9E2C';
    }
}