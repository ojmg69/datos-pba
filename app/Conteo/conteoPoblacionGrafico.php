<?php

namespace App\Conteo;

use App\Distrito;
use Illuminate\Support\Facades\DB;

class conteoPoblacionGrafico extends Conteo
{
    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {
            $countPoblacionTotal = Distrito::select(
                DB::raw('SUM(poblacion) as poblacion'),
            )
                ->first();

            $countPoblacion = Distrito::select(
                DB::raw('SUM(poblacion) as poblacion'),
                DB::raw('nombre as nombre_municipio'),
            )
                ->where('id', '=', $args['idMunicipio'])
                ->first();

            $porcentajeMunicipio = ($countPoblacion->poblacion / $countPoblacionTotal->poblacion) * 100;

            $porcentajeMunicipio = number_format($porcentajeMunicipio, 2);

            return [
                ['nombre' => $countPoblacion->nombre_municipio, 'valor' => $porcentajeMunicipio, 'color' => '#17A2B8'],
                ['nombre' => 'total provincia', 'valor' => 100 - $porcentajeMunicipio, 'color' => '#BFBFBF'],
            ];
        } else if ($this->tieneArgumento('idSeccion', $args)) {
            $countPoblacionTotal = Distrito::select(
                DB::raw('SUM(poblacion) as poblacion'),
            )
                ->first();

            $countPoblacion = Distrito::join('secciones', 'distritos.seccion_id', 'secciones.id')
                ->select(
                    DB::raw('SUM(distritos.poblacion) as poblacion'),
                    DB::raw('secciones.nombre as nombre_seccion'),
                )
                ->where('seccion_id', '=', $args['idSeccion'])
                ->first();

            $porcentajeSeccion = ($countPoblacion->poblacion / $countPoblacionTotal->poblacion) * 100;

            $porcentajeSeccion = number_format($porcentajeSeccion, 2);

            return [
                ['nombre' => $countPoblacion->nombre_seccion, 'valor' => $porcentajeSeccion, 'color' => '#17A2B8'],
                ['nombre' => 'total provincia', 'valor' => 100 - $porcentajeSeccion, 'color' => '#BFBFBF'],
            ];
        } else {
            return [
                ['nombre' => 'total provincia', 'valor' => 100, 'color' => '#BFBFBF'],
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
        return $dato['color'];
    }
}
