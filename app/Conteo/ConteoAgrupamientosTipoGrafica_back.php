<?php

namespace App\Conteo;

use App\AgrupamientoIndustrial;
use Illuminate\Support\Facades\DB;

class ConteoAgrupamientosTipoGrafica extends Conteo
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

            $totalAgrupamiento = $agrupamientoIndustrialSectorIndustrialCount->total_agrupamientos +
                $agrupamientoIndustrialParqueIndustrialCount->total_agrupamientos + $agrupamientoIndustrialPoligonoIndustrialCount->total_agrupamientos;

            $agrupamientoIndustrialSectorIndustrialPorcentaje = $totalAgrupamiento == 0 ? 0 : ($agrupamientoIndustrialSectorIndustrialCount->total_agrupamientos * 100) / $totalAgrupamiento;

            $agrupamientoIndustrialParqueIndustrialPorcentaje = $totalAgrupamiento == 0 ? 0 : ($agrupamientoIndustrialParqueIndustrialCount->total_agrupamientos * 100) / $totalAgrupamiento;

            $agrupamientoIndustrialPoligonoIndustrialPorcentaje = $totalAgrupamiento == 0 ? 0 : ($agrupamientoIndustrialPoligonoIndustrialCount->total_agrupamientos * 100) / $totalAgrupamiento;

            return [
                [
                    'nombre' => 'sectores industriales',
                    'valor' => number_format($agrupamientoIndustrialSectorIndustrialPorcentaje, 2),
                    'color' => '#4C9BF3'
                ],
                [
                    'nombre' => 'polígonos industriales',
                    'valor' => number_format($agrupamientoIndustrialParqueIndustrialPorcentaje, 2),
                    'color' => '#FCF404'
                ],
                [
                    'nombre' => 'parques industriales',
                    'valor' => number_format($agrupamientoIndustrialPoligonoIndustrialPorcentaje, 2),
                    'color' => '#D0B9DB'
                ]
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

            $totalAgrupamiento = $agrupamientoIndustrialSectorIndustrialCount->total_agrupamientos +
                $agrupamientoIndustrialParqueIndustrialCount->total_agrupamientos + $agrupamientoIndustrialPoligonoIndustrialCount->total_agrupamientos;

            $agrupamientoIndustrialSectorIndustrialPorcentaje = $totalAgrupamiento == 0 ? 0 : ($agrupamientoIndustrialSectorIndustrialCount->total_agrupamientos * 100) / $totalAgrupamiento;

            $agrupamientoIndustrialParqueIndustrialPorcentaje = $totalAgrupamiento == 0 ? 0 : ($agrupamientoIndustrialParqueIndustrialCount->total_agrupamientos * 100) / $totalAgrupamiento;

            $agrupamientoIndustrialPoligonoIndustrialPorcentaje = $totalAgrupamiento == 0 ? 0 : ($agrupamientoIndustrialPoligonoIndustrialCount->total_agrupamientos * 100) / $totalAgrupamiento;

            return [
                [
                    'nombre' => 'sectores industriales',
                    'valor' => number_format($agrupamientoIndustrialSectorIndustrialPorcentaje, 2),
                    'color' => '#4C9BF3'
                ],
                [
                    'nombre' => 'polígonos industriales',
                    'valor' => number_format($agrupamientoIndustrialParqueIndustrialPorcentaje, 2),
                    'color' => '#FCF404'
                ],
                [
                    'nombre' => 'parques industriales',
                    'valor' => number_format($agrupamientoIndustrialPoligonoIndustrialPorcentaje, 2),
                    'color' => '#D0B9DB'
                ]
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
