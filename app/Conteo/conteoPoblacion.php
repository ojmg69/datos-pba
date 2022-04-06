<?php

namespace App\Conteo;

use App\Asentamientos;
use App\Distrito;
use App\EstablecimientoSanitario;
use App\TipoEstablecimiento;
use Illuminate\Support\Facades\DB;

class ConteoPoblacion extends Conteo
{
    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args))
        {
            $countPoblacion = Distrito::select(
                DB::raw('SUM(poblacion) as poblacion'),
                DB::raw('SUM(km2) as km2'),
            )
            ->where('id', '=', $args['idMunicipio'])
            ->first();

            return [
                ['nombre' => 'población', 'valor' => $countPoblacion->poblacion],
                ['nombre' => 'densidad (hab/km2)', 'valor' => $countPoblacion->poblacion / $countPoblacion->km2],
                ['nombre' => 'superficie en km2', 'valor' => $countPoblacion->km2],
            ];
        } else if ($this->tieneArgumento('idSeccion', $args))
        {
            $countPoblacion = Distrito::select(
                DB::raw('SUM(poblacion) as poblacion'),
                DB::raw('SUM(km2) as km2'),
            )
            ->where('seccion_id', '=', $args['idSeccion'])
            ->first();

            return [
                ['nombre' => 'población', 'valor' => $countPoblacion->poblacion],
                ['nombre' => 'densidad (hab/km2)', 'valor' => $countPoblacion->poblacion / $countPoblacion->km2],
                ['nombre' => 'superficie en km2', 'valor' => $countPoblacion->km2],
            ];
        } else
        {
            $countPoblacion = Distrito::select(
                DB::raw('SUM(poblacion) as poblacion'),
                DB::raw('SUM(km2) as km2'),
            )
            ->first();

            return [
                ['nombre' => 'población', 'valor' => $countPoblacion->poblacion],
                ['nombre' => 'densidad (hab/km2)', 'valor' => $countPoblacion->poblacion / $countPoblacion->km2],
                ['nombre' => 'superficie en km2', 'valor' => $countPoblacion->km2],
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
