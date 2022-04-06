<?php

namespace App\Conteo;

use App\Electores;
use Illuminate\Support\Facades\DB;

class ConteoElectoresGrafica extends Conteo
{

    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {
            $electoresCount = Electores::join('distritos', 'electores.distrito_id', '=', 'distritos.id')
                ->select(
                    DB::raw('round((sum(electores.votantes) * 100) / sum(electores.inscriptos), 2) as total_porc_votantes'),
                )
                ->where('electores.distrito_id', '=', $args['idMunicipio']);

            if ($this->tieneArgumento('idPeriodo', $args)) {
                $electoresCount->where('electores.periodo_eleccion_id', $args['idPeriodo']);
            }

            $electoresCount = $electoresCount->first();

            $electores = is_null($electoresCount->total_porc_votantes) ? 0 : 100 - $electoresCount->total_porc_votantes;

            return [
                ['nombre' => 'inscriptos', 'valor' => $electores, 'color' => '#BFBFBF'],
                ['nombre' => 'votantes', 'valor' => $electoresCount->total_porc_votantes, 'color' => '#17A2B8']
            ];
        } else if ($this->tieneArgumento('idSeccion', $args)) {
            $electoresCount = Electores::join('distritos', 'electores.distrito_id', '=', 'distritos.id')
                ->select(
                    DB::raw('round((sum(electores.votantes) * 100) / sum(electores.inscriptos), 2) as total_porc_votantes'),
                )
                ->where('distritos.seccion_id', '=', $args['idSeccion']);

            if ($this->tieneArgumento('idPeriodo', $args)) {
                $electoresCount->where('electores.periodo_eleccion_id', $args['idPeriodo']);
            }

            $electoresCount = $electoresCount->first();

            $electores = is_null($electoresCount->total_porc_votantes) ? 0 : 100 - $electoresCount->total_porc_votantes;

            return [
                ['nombre' => 'inscriptos', 'valor' => $electores, 'color' => '#BFBFBF'],
                ['nombre' => 'votantes', 'valor' => $electoresCount->total_porc_votantes, 'color' => '#17A2B8']
            ];
        } else {
            $electoresCount = Electores::join('distritos', 'electores.distrito_id', '=', 'distritos.id')
                ->select(
                    DB::raw('round((sum(electores.votantes) * 100) / sum(electores.inscriptos), 2) as total_porc_votantes'),
                );

            if ($this->tieneArgumento('idPeriodo', $args)) {
                $electoresCount->where('electores.periodo_eleccion_id', $args['idPeriodo']);
            }

            $electoresCount = $electoresCount->first();

            $electores = is_null($electoresCount->total_porc_votantes) ? 0 : 100 - $electoresCount->total_porc_votantes;

            return [
                ['nombre' => 'inscriptos', 'valor' => $electores, 'color' => '#BFBFBF'],
                ['nombre' => 'votantes', 'valor' => $electoresCount->total_porc_votantes, 'color' => '#17A2B8']
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
