<?php

namespace App\Conteo;

use App\Intendente;

/**
 * Representa un conteo de la cantidad de intendentes por genero, ordenado de mayor a menor.
 */
class ConteoDeIntendentesPorGenero extends Conteo
{
    protected function cargarDatos($args = null)
    {
        if ($args != null && array_key_exists('idSeccion', $args) && $args['idSeccion'] != null)
        {
            $idSeccion = $args['idSeccion'];
            $femenino = Intendente::
                leftJoin('distritos', 'intendentes.distrito_id', '=', 'distritos.id')
                ->where('distritos.seccion_id', '=', $idSeccion)
                ->where('genero', '=', 'femenino')
                ->count();
        
            $masculino = Intendente::
                leftJoin('distritos', 'intendentes.distrito_id', '=', 'distritos.id')
                ->where('distritos.seccion_id', '=', $idSeccion)
                ->count();
        
            $masculino = $masculino - $femenino;

            return [
                ['nombre' => 'intendentes', 'valor' => $masculino],
                ['nombre' => 'intendentas', 'valor' => $femenino],
                ['nombre' => 'intendentes/as', 'valor' => $femenino + $masculino]
            ];
        } else
        {
            $femenino = Intendente::where('genero', '=', 'femenino')->count();
            $masculino = Intendente::count() - $femenino;
            return [
                ['nombre' => 'intendentes', 'valor' => $masculino],
                ['nombre' => 'intendentas', 'valor' => $femenino],
                ['nombre' => 'intendentes/as', 'valor' => $femenino + $masculino]
            ];
        }
    }

    protected function getNombreDeCategoria($dato)
    {
        return $dato['nombre'];
    }

    protected function getValorDeCategoria($dato)
    {
        return $dato['valor'];
    }

    protected function getColorDeCategoria($dato)
    {
        return null;
    }
}