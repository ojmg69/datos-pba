<?php

namespace App\Conteo;

use App\EstablecimientoEducativo;
use Illuminate\Support\Facades\DB;

class conteoClasificacionAdministracion extends Conteo
{

    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {
            $establecimientoTotalCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('establecimientos_educativos.distrito_id', '=', $args['idMunicipio']);

            $establecimientoTotalPrivadoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('sector_educativo.nombre', 'Privado')
                ->where('establecimientos_educativos.distrito_id', '=', $args['idMunicipio']);

            $establecimientoTotalPublicoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('sector_educativo.nombre', 'Público')
                ->where('establecimientos_educativos.distrito_id', $args['idMunicipio']);

            if ($this->tieneArgumento('Especial', $args)) {
                $establecimientoTotalCount->where('establecimientos_educativos.modalidad', $args['Especial']);
                $establecimientoTotalPrivadoCount->where('establecimientos_educativos.modalidad', $args['Especial']);
                $establecimientoTotalPublicoCount->where('establecimientos_educativos.modalidad', $args['Especial']);
            }


            return [
                ['nombre' => 'total', 'valor' => $establecimientoTotalCount->first()->total_establecimientos],
                ['nombre' => 'privados', 'valor' => $establecimientoTotalPrivadoCount->first()->total_establecimientos],
                ['nombre' => 'públicos', 'valor' => $establecimientoTotalPublicoCount->first()->total_establecimientos],
            ];
        } else if ($this->tieneArgumento('idSeccion', $args)) {

            $establecimientoTotalCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->join('distritos', 'distritos.id', '=', 'establecimientos_educativos.distrito_id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('distritos.seccion_id', '=', $args['idSeccion']);

            $establecimientoTotalPrivadoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->join('distritos', 'distritos.id', '=', 'establecimientos_educativos.distrito_id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->where('sector_educativo.nombre', '=', 'Privado');

            $establecimientoTotalPublicoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->join('distritos', 'distritos.id', '=', 'establecimientos_educativos.distrito_id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->where('sector_educativo.nombre', '=', 'Público');

            if ($this->tieneArgumento('Especial', $args)) {
                $establecimientoTotalCount->where('establecimientos_educativos.modalidad', $args['Especial']);
                $establecimientoTotalPrivadoCount->where('establecimientos_educativos.modalidad', $args['Especial']);
                $establecimientoTotalPublicoCount->where('establecimientos_educativos.modalidad', $args['Especial']);
            }

            return [
                ['nombre' => 'total', 'valor' => $establecimientoTotalCount->first()->total_establecimientos],
                ['nombre' => 'privados', 'valor' => $establecimientoTotalPrivadoCount->first()->total_establecimientos],
                ['nombre' => 'publicos', 'valor' => $establecimientoTotalPublicoCount->first()->total_establecimientos],
            ];
        } else {
            $establecimientoTotalCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                );
            $establecimientoTotalPrivadoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('sector_educativo.nombre', '=', 'Privado');

            $establecimientoTotalPublicoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('sector_educativo.nombre', '=', 'Público');

            if ($this->tieneArgumento('Especial', $args)) {
                $establecimientoTotalCount->where('establecimientos_educativos.modalidad', $args['Especial']);
                $establecimientoTotalPrivadoCount->where('establecimientos_educativos.modalidad', $args['Especial']);
                $establecimientoTotalPublicoCount->where('establecimientos_educativos.modalidad', $args['Especial']);
            }

            return [
                ['nombre' => 'total', 'valor' => $establecimientoTotalCount->first()->total_establecimientos],
                ['nombre' => 'privados', 'valor' => $establecimientoTotalPrivadoCount->first()->total_establecimientos],
                ['nombre' => 'públicos', 'valor' => $establecimientoTotalPublicoCount->first()->total_establecimientos],
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
