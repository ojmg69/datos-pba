<?php

namespace App\Conteo;

use App\CircuitosElectorales;
use Illuminate\Support\Facades\DB;

class ConteoCircuitosMesas extends Conteo
{

    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {
            $circuitosElectoralesCount = CircuitosElectorales::join('distritos', 'circuitos_electorales.distrito_id', '=', 'distritos.id')
                ->select(
                    DB::raw('count(circuitos_electorales.circuito) as total_circuito'),
                    DB::raw('sum(circuitos_electorales.cantidad_mesas) as total_cantidad_mesas'),
                    DB::raw('sum(circuitos_electorales.mesas_especiales) as total_mesas_especiales'),
                )
                ->where('circuitos_electorales.distrito_id', '=', $args['idMunicipio']);

            if ($this->tieneArgumento('idPeriodo', $args)) {
                $circuitosElectoralesCount->where('circuitos_electorales.periodo_eleccion_id', $args['idPeriodo']);
            }

            $circuitosElectoralesCount = $circuitosElectoralesCount->first();

            $circuitosElectoralesCount->total_inscriptos = (float)str_replace('.', '', $circuitosElectoralesCount->total_inscriptos);
            $circuitosElectoralesCount->total_votantes = (float)str_replace('.', '', $circuitosElectoralesCount->total_votantes);

            return [
                ['nombre' => 'circuitos', 'valor' => $circuitosElectoralesCount->total_circuito],
                ['nombre' => 'mesas habilitadas', 'valor' => $circuitosElectoralesCount->total_cantidad_mesas],
                ['nombre' => 'mesas especiales', 'valor' => $circuitosElectoralesCount->total_mesas_especiales]
            ];

        } else if ($this->tieneArgumento('idSeccion', $args)) {
            $circuitosElectoralesCount = CircuitosElectorales::join('distritos', 'circuitos_electorales.distrito_id', '=', 'distritos.id')
                ->select(
                    DB::raw('count(circuitos_electorales.circuito) as total_circuito'),
                    DB::raw('sum(circuitos_electorales.cantidad_mesas) as total_cantidad_mesas'),
                    DB::raw('sum(circuitos_electorales.mesas_especiales) as total_mesas_especiales'),
                )
                ->where('distritos.seccion_id', '=', $args['idSeccion']);
            
            if ($this->tieneArgumento('idPeriodo', $args)) {
                $circuitosElectoralesCount->where('circuitos_electorales.periodo_eleccion_id', $args['idPeriodo']);
            }

            $circuitosElectoralesCount = $circuitosElectoralesCount->first();

            $circuitosElectoralesCount->total_circuito = (float)str_replace('.', '', $circuitosElectoralesCount->total_circuito);
            $circuitosElectoralesCount->total_cantidad_mesas = (float)str_replace('.', '', $circuitosElectoralesCount->total_cantidad_mesas);
            $circuitosElectoralesCount->total_mesas_especiales = (float)str_replace('.', '', $circuitosElectoralesCount->total_mesas_especiales);

            return [
                ['nombre' => 'circuitos', 'valor' => $circuitosElectoralesCount->total_circuito],
                ['nombre' => 'mesas habilitadas', 'valor' => $circuitosElectoralesCount->total_cantidad_mesas],
                ['nombre' => 'mesas especiales', 'valor' => $circuitosElectoralesCount->total_mesas_especiales]
            ];
        } else {
            $circuitosElectoralesCount = CircuitosElectorales::join('distritos', 'circuitos_electorales.distrito_id', '=', 'distritos.id')
                ->select(
                     DB::raw('count(circuitos_electorales.circuito) as total_circuito'),
                    DB::raw('sum(circuitos_electorales.cantidad_mesas) as total_cantidad_mesas'),
                    DB::raw('sum(circuitos_electorales.mesas_especiales) as total_mesas_especiales'),
                );
                
                
            if ($this->tieneArgumento('idPeriodo', $args)) {
                $circuitosElectoralesCount->where('circuitos_electorales.periodo_eleccion_id', $args['idPeriodo']);
            }

            $circuitosElectoralesCount = $circuitosElectoralesCount->first();

            $circuitosElectoralesCount->total_inscriptos = (float)str_replace('.', '', $circuitosElectoralesCount->total_inscriptos);
            $circuitosElectoralesCount->total_votantes = (float)str_replace('.', '', $circuitosElectoralesCount->total_votantes);
            return [
                 ['nombre' => 'circuitos', 'valor' => $circuitosElectoralesCount->total_circuito],
                ['nombre' => 'mesas habilitadas', 'valor' => $circuitosElectoralesCount->total_cantidad_mesas],
                ['nombre' => 'mesas especiales', 'valor' => $circuitosElectoralesCount->total_mesas_especiales]
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
