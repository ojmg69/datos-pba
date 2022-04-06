<?php

namespace App\Conteo;

use App\AgrupamientoIndustrial;
use Illuminate\Support\Facades\DB;

class ConteoAgrupamientosNumero extends Conteo
{

    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {
            $agrupamientoIndustrialCount = AgrupamientoIndustrial::join('distritos', 'agrupamiento_industriales.distrito_id', '=', 'distritos.id')
                ->select(
                    DB::raw('count(*) as total_agrupamientos'),
                    DB::raw('sum(agrupamiento_industriales.numero_de_empresas) as total_empresas'),
                    DB::raw('sum(agrupamiento_industriales.numero_de_empleados_estimado) as total_empleados'),
                );
                ->where('agrupamiento_industriales.distrito_id', '=', $args['idMunicipio'])
                ->first();

            return [
                ['nombre' => 'agrupamientos', 'valor' => $agrupamientoIndustrialCount->total_agrupamientos],
                ['nombre' => 'empresas', 'valor' => $agrupamientoIndustrialCount->total_empresas],
                ['nombre' => 'empleados', 'valor' => $agrupamientoIndustrialCount->total_empleados]
            ];
        } else if ($this->tieneArgumento('idSeccion', $args)) {
            $agrupamientoIndustrialCount = AgrupamientoIndustrial::join('agrupamientos_tipo', 'agrupamiento_industriales.tipo', '=', 'agrupamientos_tipo.id')
                ->join('distritos', 'distritos.id', '=', 'agrupamiento_industriales.distrito_id')
                ->select(
                    DB::raw('count(*) as total_agrupamientos'),
                    DB::raw('sum(agrupamiento_industriales.numero_de_empresas) as total_empresas'),
                    DB::raw('sum(agrupamiento_industriales.numero_de_empleados_estimado) as total_empleados'),
                )
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->first();

            return [
                ['nombre' => 'agrupamientos', 'valor' => $agrupamientoIndustrialCount->total_agrupamientos],
                ['nombre' => 'empresas', 'valor' => $agrupamientoIndustrialCount->total_empresas],
                ['nombre' => 'empleados', 'valor' => $agrupamientoIndustrialCount->total_empleados]
            ];
        } else {
            $agrupamientoIndustrialCount = AgrupamientoIndustrial::join('distritos', 'agrupamiento_industriales.distrito_id', '=', 'distritos.id')
                ->select(
                    DB::raw('count(*) as total_agrupamientos'),
                    DB::raw('sum(agrupamiento_industriales.numero_de_empresas) as total_empresas'),
                    DB::raw('sum(agrupamiento_industriales.numero_de_empleados_estimado) as total_empleados'),
                )
                ->first();

            return [
                ['nombre' => 'agrupamientos', 'valor' => $agrupamientoIndustrialCount->total_agrupamientos],
                ['nombre' => 'empresas', 'valor' => $agrupamientoIndustrialCount->total_empresas],
                ['nombre' => 'empleados', 'valor' => $agrupamientoIndustrialCount->total_empleados]
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
