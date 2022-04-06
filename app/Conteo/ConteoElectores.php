<?php

namespace App\Conteo;

use App\Electores;
use Illuminate\Support\Facades\DB;

class ConteoElectores extends Conteo
{

    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {
            $electoresCount = Electores::join('distritos', 'electores.distrito_id', '=', 'distritos.id')
                ->select(
                    DB::raw('sum(electores.inscriptos) as total_inscriptos'),
                    DB::raw('sum(electores.votantes) as total_votantes'),
                    DB::raw('round((sum(electores.votantes) * 100) / sum(electores.inscriptos), 2) as total_porc_votantes'),
                )
                ->where('electores.distrito_id', '=', $args['idMunicipio']);

            if ($this->tieneArgumento('idPeriodo', $args)) {
                $electoresCount->where('electores.periodo_eleccion_id', $args['idPeriodo']);
            }

            $electoresCount = $electoresCount->first();

            $electoresCount->total_inscriptos = (float)str_replace('.', '', $electoresCount->total_inscriptos);
            $electoresCount->total_votantes = (float)str_replace('.', '', $electoresCount->total_votantes);

            return [
                ['nombre' => 'inscriptos', 'valor' => $electoresCount->total_inscriptos],
                ['nombre' => 'votantes', 'valor' => $electoresCount->total_votantes],
                ['nombre' => 'concurrencia', 'valor' => $electoresCount->total_porc_votantes]
            ];

        } else if ($this->tieneArgumento('idSeccion', $args)) {
            $electoresCount = Electores::join('distritos', 'electores.distrito_id', '=', 'distritos.id')
                ->select(
                    DB::raw('sum(electores.inscriptos) as total_inscriptos'),
                    DB::raw('sum(electores.votantes) as total_votantes'),
                    DB::raw('round((sum(electores.votantes) * 100) / sum(electores.inscriptos), 2) as total_porc_votantes'),
                )
                ->where('distritos.seccion_id', '=', $args['idSeccion']);
            
            if ($this->tieneArgumento('idPeriodo', $args)) {
                $electoresCount->where('electores.periodo_eleccion_id', $args['idPeriodo']);
            }

            $electoresCount = $electoresCount->first();

            $electoresCount->total_inscriptos = (float)str_replace('.', '', $electoresCount->total_inscriptos);
            $electoresCount->total_votantes = (float)str_replace('.', '', $electoresCount->total_votantes);

            return [
                ['nombre' => 'inscriptos', 'valor' => $electoresCount->total_inscriptos],
                ['nombre' => 'votantes', 'valor' => $electoresCount->total_votantes],
                ['nombre' => 'concurrencia', 'valor' => $electoresCount->total_porc_votantes]
            ];
        } else {
            $electoresCount = Electores::join('distritos', 'electores.distrito_id', '=', 'distritos.id')
                ->select(
                    DB::raw('sum(electores.inscriptos) as total_inscriptos'),
                    DB::raw('sum(electores.votantes) as total_votantes'),
                    DB::raw('round((sum(electores.votantes) * 100) / sum(electores.inscriptos), 2) as total_porc_votantes'),
                );
                
                
            if ($this->tieneArgumento('idPeriodo', $args)) {
                $electoresCount->where('electores.periodo_eleccion_id', $args['idPeriodo']);
            }

            $electoresCount = $electoresCount->first();

            $electoresCount->total_inscriptos = (float)str_replace('.', '', $electoresCount->total_inscriptos);
            $electoresCount->total_votantes = (float)str_replace('.', '', $electoresCount->total_votantes);
            return [
                ['nombre' => 'inscriptos', 'valor' => $electoresCount->total_inscriptos],
                ['nombre' => 'votantes', 'valor' => $electoresCount->total_votantes],
                ['nombre' => 'concurrencia', 'valor' => $electoresCount->total_porc_votantes]
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
