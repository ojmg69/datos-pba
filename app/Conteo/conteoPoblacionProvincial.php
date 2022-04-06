<?php

namespace App\Conteo;

use App\Distrito;
use Illuminate\Support\Facades\DB;

class conteoPoblacionProvincial extends Conteo
{
    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args))
        {
            $countPoblacionTotal = Distrito::select(
                DB::raw('SUM(poblacion) as poblacion'),
                DB::raw('SUM(km2) as km2'),
            )
            ->first();

            $countPoblacion = Distrito::select(
                DB::raw('SUM(poblacion) as poblacion'),
                DB::raw('SUM(km2) as km2'),
            )
            ->where('id', '=', $args['idMunicipio'])
            ->first();

            return [
                ['nombre' => '% de población provincial', 'valor' => ($countPoblacion->poblacion / $countPoblacionTotal->poblacion) * 100],
                ['nombre' => '% de la superficie provincial', 'valor' => ($countPoblacion->km2 / $countPoblacionTotal->km2) * 100],
            ];
        } else if ($this->tieneArgumento('idSeccion', $args))
        {
            $countPoblacionTotal = Distrito::select(
                DB::raw('SUM(poblacion) as poblacion'),
                DB::raw('SUM(km2) as km2'),
            )
            ->first();

            $countPoblacion = Distrito::select(
                DB::raw('SUM(poblacion) as poblacion'),
                DB::raw('SUM(km2) as km2'),
            )
            ->where('seccion_id', '=', $args['idSeccion'])
            ->first();


            return [
                ['nombre' => '% de población provincial', 'valor' => ($countPoblacion->poblacion / $countPoblacionTotal->poblacion) * 100],
                ['nombre' => '% de la superficie provincial', 'valor' => ($countPoblacion->km2 / $countPoblacionTotal->km2) * 100],
            ];
        } else
        {
            $countPoblacion = Distrito::select(
                DB::raw('SUM(poblacion) as poblacion'),
                DB::raw('SUM(densidad) as densidad'),
                DB::raw('SUM(km2) as km2'),
            )
            ->first();

            return [
                ['nombre' => '% de población provincial', 'valor' => 100],
                ['nombre' => '% de la superficie provincial', 'valor' => 100],
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
