<?php

namespace App\Conteo;

use App\AgrupamientoIndustrial;
use Illuminate\Support\Facades\DB;

class ConteoAgrupamientosTipo extends Conteo
{

    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {

            $agrupamientoIndustrialSectorIndustrialCount = AgrupamientoIndustrial::join('agrupamientos_tipo', 'agrupamiento_industriales.tipo', '=', 'agrupamientos_tipo.id')
                ->select(
                    DB::raw('count(*) as total_agrupamientos')
                )
                ->where('agrupamientos_tipo.nombre', '=', 'SECTOR INDUSTRIAL PLANIFICADO')
                ->where('agrupamiento_industriales.distrito_id', '=', $args['idMunicipio'])
                ->first();
            $agrupamientoIndustrialParqueIndustrialCount = AgrupamientoIndustrial::join('agrupamientos_tipo', 'agrupamiento_industriales.tipo', '=', 'agrupamientos_tipo.id')
                ->select(
                    DB::raw('count(*) as total_agrupamientos')
                )
                ->where('agrupamientos_tipo.nombre', '=', 'PARQUE INDUSTRIAL')
                ->where('agrupamiento_industriales.distrito_id', '=', $args['idMunicipio'])
                ->first();

            $agrupamientoIndustrialPoligonoIndustrialCount = AgrupamientoIndustrial::join('agrupamientos_tipo', 'agrupamiento_industriales.tipo', '=', 'agrupamientos_tipo.id')
                ->select(
                    DB::raw('count(*) as total_agrupamientos')
                )
                ->where('agrupamientos_tipo.nombre', '=', 'POLÃGONO INDUSTRIAL')
                ->where('agrupamiento_industriales.distrito_id', '=', $args['idMunicipio'])
                ->first();

            return [
                ['nombre' => 'sectores industriales', 'valor' => $agrupamientoIndustrialSectorIndustrialCount->total_agrupamientos],
                ['nombre' => 'polígonos industriales', 'valor' => $agrupamientoIndustrialParqueIndustrialCount->total_agrupamientos],
                ['nombre' => 'parques industriales', 'valor' => $agrupamientoIndustrialPoligonoIndustrialCount->total_agrupamientos]
            ];
        } else {
            $agrupamientoIndustrialSectorIndustrialCount = AgrupamientoIndustrial::join('agrupamientos_tipo', 'agrupamiento_industriales.tipo', '=', 'agrupamientos_tipo.id')
                ->select(
                    DB::raw('count(*) as total_agrupamientos')
                )
                ->where('agrupamientos_tipo.nombre', '=', 'SECTOR INDUSTRIAL PLANIFICADO')
                ->first();
            $agrupamientoIndustrialParqueIndustrialCount = AgrupamientoIndustrial::join('agrupamientos_tipo', 'agrupamiento_industriales.tipo', '=', 'agrupamientos_tipo.id')
                ->select(
                    DB::raw('count(*) as total_agrupamientos')
                )
                ->where('agrupamientos_tipo.nombre', '=', 'PARQUE INDUSTRIAL')
                ->first();

            $agrupamientoIndustrialPoligonoIndustrialCount = AgrupamientoIndustrial::join('agrupamientos_tipo', 'agrupamiento_industriales.tipo', '=', 'agrupamientos_tipo.id')
                ->select(
                    DB::raw('count(*) as total_agrupamientos')
                )
                ->where('agrupamientos_tipo.nombre', '=', 'POLÃGONO INDUSTRIAL')
                ->first();

            return [
                ['nombre' => 'sectores industriales', 'valor' => $agrupamientoIndustrialSectorIndustrialCount->total_agrupamientos],
                ['nombre' => 'polígonos industriales', 'valor' => $agrupamientoIndustrialParqueIndustrialCount->total_agrupamientos],
                ['nombre' => 'parques industriales', 'valor' => $agrupamientoIndustrialPoligonoIndustrialCount->total_agrupamientos]
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
