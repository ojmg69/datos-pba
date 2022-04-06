<?php

namespace App\Conteo;

use App\Bloque;
use App\ConcejoDeliberante;
use App\Legisladores;

/**
 * Conteo de la cantidad de concejales por bloque
 */
class ConteoDeBloqueLegisladoresSenadores extends Conteo
{
    /**
     * $args :: [ idSeccion => int ] | null
     */
    protected function cargarDatos($args)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {

            $legisladoresFrenteDeTodos = Legisladores::join('distritos', 'legisladores.distrito_id', '=', 'distritos.id')
                ->join('bloques', 'legisladores.bloque_leg_id', '=', 'bloques.id')
                ->selectRaw('count(*) as legisladores, bloques.color, bloques.nombre')
                ->where('legisladores.distrito_id', '=', $args['idMunicipio'])
                ->where('legisladores.tipo', 'like', '%SENADOR%')
                ->where('bloques.nombre', 'FRENTE DE TODOS')
                ->first();

            $legisladoresJuntosPorElCambio = Legisladores::join('distritos', 'legisladores.distrito_id', '=', 'distritos.id')
                ->join('bloques', 'legisladores.bloque_leg_id', '=', 'bloques.id')
                ->selectRaw('count(*) as legisladores, bloques.color, bloques.nombre')
                ->where('legisladores.distrito_id', '=', $args['idMunicipio'])
                ->where('legisladores.tipo', 'like', '%SENADOR%')
                ->where('bloques.nombre', 'JUNTOS POR EL CAMBIO')
                ->first();

            $legisladoresOtrosBloques = Legisladores::join('distritos', 'legisladores.distrito_id', '=', 'distritos.id')
                ->join('bloques', 'legisladores.bloque_leg_id', '=', 'bloques.id')
                ->selectRaw('count(*) as legisladores, bloques.color, bloques.nombre')
                ->where('legisladores.distrito_id', '=', $args['idMunicipio'])
                ->where('legisladores.tipo', 'like', '%SENADOR%')
                ->where('bloques.nombre', '!=', 'JUNTOS POR EL CAMBIO')
                ->where('bloques.nombre', '!=', 'FRENTE DE TODOS')
                ->first();

            return [
                ['nombre' => 'FRENTE DE TODOS', 'valor' => $legisladoresFrenteDeTodos->legisladores, "color" => "#4C9BF3"],
                ['nombre' => 'JUNTOS POR EL CAMBIO', 'valor' => $legisladoresJuntosPorElCambio->legisladores, "color" => "#FCF404"],
                ['nombre' => 'OTROS BLOQUES', 'valor' => $legisladoresOtrosBloques->legisladores, "color" => "#D0B9DB"]
            ];
        } else if ($this->tieneArgumento('idSeccion', $args)) {
            $legisladoresFrenteDeTodos = Legisladores::join('distritos', 'legisladores.distrito_id', '=', 'distritos.id')
                ->join('secciones', 'distritos.seccion_id', '=', 'secciones.id')
                ->join('bloques', 'legisladores.bloque_leg_id', '=', 'bloques.id')
                ->selectRaw('count(*) as legisladores, bloques.color, bloques.nombre')
                ->where('secciones.id', '=', $args['idSeccion'])
                ->where('legisladores.tipo', 'like', '%SENADOR%')
                ->where('bloques.nombre', 'FRENTE DE TODOS')
                ->first();

            $legisladoresJuntosPorElCambio = Legisladores::join('distritos', 'legisladores.distrito_id', '=', 'distritos.id')
                ->join('secciones', 'distritos.seccion_id', '=', 'secciones.id')
                ->join('bloques', 'legisladores.bloque_leg_id', '=', 'bloques.id')
                ->selectRaw('count(*) as legisladores, bloques.color, bloques.nombre')
                ->where('secciones.id', '=', $args['idSeccion'])
                ->where('legisladores.tipo', 'like', '%SENADOR%')
                ->where('bloques.nombre', 'JUNTOS POR EL CAMBIO')
                ->first();

            $legisladoresOtrosBloques = Legisladores::join('distritos', 'legisladores.distrito_id', '=', 'distritos.id')
                ->join('secciones', 'distritos.seccion_id', '=', 'secciones.id')
                ->join('bloques', 'legisladores.bloque_leg_id', '=', 'bloques.id')
                ->selectRaw('count(*) as legisladores, bloques.color, bloques.nombre')
                ->where('secciones.id', '=', $args['idSeccion'])
                ->where('legisladores.tipo', 'like', '%SENADOR%')
                ->where('bloques.nombre', '!=', 'JUNTOS POR EL CAMBIO')
                ->where('bloques.nombre', '!=', 'FRENTE DE TODOS')
                ->first();

            return [
                ['nombre' => 'FRENTE DE TODOS', 'valor' => $legisladoresFrenteDeTodos->legisladores, "color" => "#4C9BF3"],
                ['nombre' => 'JUNTOS POR EL CAMBIO', 'valor' => $legisladoresJuntosPorElCambio->legisladores, "color" => "#FCF404"],
                ['nombre' => 'OTROS BLOQUES', 'valor' => $legisladoresOtrosBloques->legisladores, "color" => "#D0B9DB"]
            ];
        } else {
            $legisladoresFrenteDeTodos = Legisladores::join('distritos', 'legisladores.distrito_id', '=', 'distritos.id')
                ->join('bloques', 'legisladores.bloque_leg_id', '=', 'bloques.id')
                ->selectRaw('count(*) as legisladores, bloques.color, bloques.nombre')
                ->where('legisladores.tipo', 'like', '%SENADOR%')
                ->where('bloques.nombre', 'FRENTE DE TODOS')
                ->first();

            $legisladoresJuntosPorElCambio = Legisladores::join('distritos', 'legisladores.distrito_id', '=', 'distritos.id')
                ->join('bloques', 'legisladores.bloque_leg_id', '=', 'bloques.id')
                ->selectRaw('count(*) as legisladores, bloques.color, bloques.nombre')
                ->where('legisladores.tipo', 'like', '%SENADOR%')
                ->where('bloques.nombre', 'JUNTOS POR EL CAMBIO')
                ->first();

            $legisladoresOtrosBloques = Legisladores::join('distritos', 'legisladores.distrito_id', '=', 'distritos.id')
                ->join('bloques', 'legisladores.bloque_leg_id', '=', 'bloques.id')
                ->selectRaw('count(*) as legisladores, bloques.color, bloques.nombre')
                ->where('legisladores.tipo', 'like', '%SENADOR%')
                ->where('bloques.nombre', '!=', 'JUNTOS POR EL CAMBIO')
                ->where('bloques.nombre', '!=', 'FRENTE DE TODOS')
                ->first();

            return [
                ['nombre' => 'FRENTE DE TODOS', 'valor' => $legisladoresFrenteDeTodos->legisladores, "color" => "#4C9BF3"],
                ['nombre' => 'JUNTOS POR EL CAMBIO', 'valor' => $legisladoresJuntosPorElCambio->legisladores, "color" => "#FCF404"],
                ['nombre' => 'OTROS BLOQUES', 'valor' => $legisladoresOtrosBloques->legisladores, "color" => "#D0B9DB"]
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

    protected function getNombreDeCategoriaRestante()
    {
        return 'OTROS BLOQUES';
    }

    protected function getColorDeCategoriaRestante()
    {
        return "#D0B9DB";
    }
}
