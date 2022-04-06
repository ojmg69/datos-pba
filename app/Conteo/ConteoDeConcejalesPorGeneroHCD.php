<?php

namespace App\Conteo;

use App\ConcejoDeliberante;

class ConteoDeConcejalesPorGeneroHCD extends Conteo
{
    /**
     * $args :: [ idSeccion => int ] | [ idMunicipio => int ] | null
     */
    protected function cargarDatos($args)
    {
        if ($this->tieneArgumento('idMunicipio', $args))
        {
            $concejales = ConcejoDeliberante::
                join('distritos', 'concejo_deliberantes.distrito_id', '=', 'distritos.id')
                ->where('distritos.id', '=', $args['idMunicipio'])
                ->where('genero', '=', 'MASCULINO')
                ->count();

            $concejalas = ConcejoDeliberante::
                join('distritos', 'concejo_deliberantes.distrito_id', '=', 'distritos.id')
                ->where('distritos.id', '=', $args['idMunicipio'])
                ->where('genero', '=', 'FEMENINO')
                ->count();

            return [
                [ $concejales, 'concejales' ],
                [ $concejalas, 'concejalas' ],
                [ $concejalas + $concejales, 'total' ],
            ];
        }
        else if ($this->tieneArgumento('idSeccion', $args))
        {                
            $concejales = ConcejoDeliberante::
                join('distritos', 'concejo_deliberantes.distrito_id', '=', 'distritos.id')
                ->join('secciones', 'distritos.seccion_id', '=', 'secciones.id')
                ->where('secciones.id', '=', $args['idSeccion'])
                ->where('genero', '=', 'MASCULINO')
                ->count();

            $concejalas = ConcejoDeliberante::
                join('distritos', 'concejo_deliberantes.distrito_id', '=', 'distritos.id')
                ->join('secciones', 'distritos.seccion_id', '=', 'secciones.id')
                ->where('secciones.id', '=', $args['idSeccion'])
                ->where('genero', '=', 'FEMENINO')
                ->count();

            return [
                [ $concejales, 'concejales' ],
                [ $concejalas, 'concejalas' ],
                [ $concejalas + $concejales, 'total' ],
            ];
        } else
        {
            $concejales = ConcejoDeliberante::
                selectRaw('count(*) as concejales')
                ->where('genero', '=', 'MASCULINO')
                ->count();

            $concejalas = ConcejoDeliberante::
                selectRaw('count(*) as concejales')
                ->where('genero', '=', 'FEMENINO')
                ->count();

            return [
                [ $concejales, 'concejales' ],
                [ $concejalas, 'concejalas' ],
                [ $concejalas + $concejales, 'total' ],
            ];
        }
    }

    protected function getValorDeCategoria($dato)
    {
        return $dato[0];
    }

    protected function getNombreDeCategoria($dato)
    {
        return $dato[1];
    }

    protected function getColorDeCategoria($dato)
    {
        return null;
    }
}