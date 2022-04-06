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
                ->where('electores.distrito_id', '=', $args['idMunicipio'])
                ->first();

            return [
                ['nombre' => 'inscriptos', 'valor' => 100 - $electoresCount->total_porc_votantes, 'color' => '#4C9BF3'],
                ['nombre' => 'votantes', 'valor' => $electoresCount->total_porc_votantes, 'color' => '#FCF404']
            ];
        } else if ($this->tieneArgumento('idSeccion', $args)) {
            $electoresCount = Electores::join('distritos', 'electores.distrito_id', '=', 'distritos.id')
                ->select(
                    DB::raw('round((sum(electores.votantes) * 100) / sum(electores.inscriptos), 2) as total_porc_votantes'),
                )
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->first();

            return [
                ['nombre' => 'inscriptos', 'valor' => 100 - $electoresCount->total_porc_votantes, 'color' => '#4C9BF3'],
                ['nombre' => 'votantes', 'valor' => $electoresCount->total_porc_votantes, 'color' => '#FCF404']
            ];
        } else {
            $electoresCount = Electores::join('distritos', 'electores.distrito_id', '=', 'distritos.id')
                ->select(
                    DB::raw('round((sum(electores.votantes) * 100) / sum(electores.inscriptos), 2) as total_porc_votantes'),
                )
                ->first();

            return [
                ['nombre' => 'inscriptos', 'valor' => 100 - $electoresCount->total_porc_votantes, 'color' => '#4C9BF3'],
                ['nombre' => 'votantes', 'valor' => $electoresCount->total_porc_votantes, 'color' => '#FCF404']
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
