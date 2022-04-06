<?php

namespace App\Conteo;

use App\EstablecimientoEducativo;
use Illuminate\Support\Facades\DB;

class conteoClasificacionNivelesEspecial extends Conteo
{

    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {
            $establecimientoInicialTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Inicial')
                ->where('establecimientos_educativos.distrito_id', '=', $args['idMunicipio']);

            $establecimientoPrimarioTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Primaria / Secundaria')
                ->where('establecimientos_educativos.distrito_id', '=', $args['idMunicipio']);

            $establecimientoOtrosTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Otros')
                ->where('establecimientos_educativos.distrito_id', '=', $args['idMunicipio']);

            if ($this->tieneArgumento('Especial', $args)) {
                $establecimientoInicialTotalCount->where('establecimientos_educativos.modalidad', $args['Especial']);
                $establecimientoPrimarioTotalCount->where('establecimientos_educativos.modalidad', $args['Especial']);
                $establecimientoUniversitarioTotalCount->where('establecimientos_educativos.modalidad', $args['Especial']);
                $establecimientoOtrosTotalCount->where('establecimientos_educativos.modalidad', $args['Especial']);
            }

            return [
                ['nombre' => 'inicial', 'valor' => $establecimientoInicialTotalCount->first()->total_establecimientos],
                ['nombre' => 'primario / secundario', 'valor' => $establecimientoPrimarioTotalCount->first()->total_establecimientos],
               
                ['nombre' => 'otros', 'valor' => $establecimientoOtrosTotalCount->first()->total_establecimientos],
            ];
        } else if ($this->tieneArgumento('idSeccion', $args)) {

            $establecimientoInicialTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->join('distritos', 'distritos.id', '=', 'establecimientos_educativos.distrito_id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Inicial')
                ->where('distritos.seccion_id', '=', $args['idSeccion']);

            $establecimientoPrimarioTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->join('distritos', 'distritos.id', '=', 'establecimientos_educativos.distrito_id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Primaria / Secundaria')
                ->where('distritos.seccion_id', '=', $args['idSeccion']);

            $establecimientoUniversitarioTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->join('distritos', 'distritos.id', '=', 'establecimientos_educativos.distrito_id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )

                ->where('distritos.seccion_id', '=', $args['idSeccion']);

            $establecimientoOtrosTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->join('distritos', 'distritos.id', '=', 'establecimientos_educativos.distrito_id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Otros')
                ->where('distritos.seccion_id', '=', $args['idSeccion']);

            if ($this->tieneArgumento('Especial', $args)) {
                $establecimientoInicialTotalCount->where('establecimientos_educativos.modalidad', $args['Especial']);
                $establecimientoPrimarioTotalCount->where('establecimientos_educativos.modalidad', $args['Especial']);
                $establecimientoUniversitarioTotalCount->where('establecimientos_educativos.modalidad', $args['Especial']);
                $establecimientoOtrosTotalCount->where('establecimientos_educativos.modalidad', $args['Especial']);
            }

            return [
                ['nombre' => 'inicial', 'valor' => $establecimientoInicialTotalCount->first()->total_establecimientos],
                ['nombre' => 'primario / secundario', 'valor' => $establecimientoPrimarioTotalCount->first()->total_establecimientos],
               
                ['nombre' => 'otros', 'valor' => $establecimientoOtrosTotalCount->first()->total_establecimientos],
            ];
        } else {
            $establecimientoInicialTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Inicial');

            $establecimientoPrimarioTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Primaria / Secundaria');

            $establecimientoUniversitarioTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                

            $establecimientoOtrosTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Otros');

            if ($this->tieneArgumento('Especial', $args)) {
                $establecimientoInicialTotalCount->where('establecimientos_educativos.modalidad', $args['Especial']);
                $establecimientoPrimarioTotalCount->where('establecimientos_educativos.modalidad', $args['Especial']);
                $establecimientoUniversitarioTotalCount->where('establecimientos_educativos.modalidad', $args['Especial']);
                $establecimientoOtrosTotalCount->where('establecimientos_educativos.modalidad', $args['Especial']);
            }

            return [
                ['nombre' => 'inicial', 'valor' => $establecimientoInicialTotalCount->first()->total_establecimientos],
                ['nombre' => 'primario / secundario', 'valor' => $establecimientoPrimarioTotalCount->first()->total_establecimientos],

                ['nombre' => 'otros', 'valor' => $establecimientoOtrosTotalCount->first()->total_establecimientos],
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
