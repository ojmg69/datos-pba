<?php

namespace App\Conteo;

use App\EstablecimientoEducativo;
use Illuminate\Support\Facades\DB;

class conteoClasificacionAdministracionGrafica extends Conteo
{

    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {
            $establecimientoTotalPrivadoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                    DB::raw('sector_educativo.color'),
                )
                ->where('establecimientos_educativos.distrito_id', '=', $args['idMunicipio'])
                ->where('sector_educativo.nombre', '=', 'Privado')
                ->first();
            $establecimientoTotalPublicoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                    DB::raw('sector_educativo.color'),
                )
                ->where('establecimientos_educativos.distrito_id', '=', $args['idMunicipio'])
                ->where('sector_educativo.nombre', '=', 'Estatal')
                ->first();

            return [
                ['nombre' => 'privados', 'valor' => $establecimientoTotalPrivadoCount->total_establecimientos, 'color' => $establecimientoTotalPrivadoCount->color],
                ['nombre' => 'publicos', 'valor' => $establecimientoTotalPublicoCount->total_establecimientos, 'color' => $establecimientoTotalPublicoCount->color],
            ];
        } else if ($this->tieneArgumento('idSeccion', $args)) {

            $establecimientoTotalPrivadoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->join('distritos', 'distritos.id', '=', 'establecimientos_educativos.distrito_id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                    DB::raw('sector_educativo.color'),
                )
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->where('sector_educativo.nombre', '=', 'Privado')
                ->first();
            $establecimientoTotalPublicoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->join('distritos', 'distritos.id', '=', 'establecimientos_educativos.distrito_id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                    DB::raw('sector_educativo.color'),
                )
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->where('sector_educativo.nombre', '=', 'Estatal')
                ->first();

            return [
                ['nombre' => 'privados', 'valor' => $establecimientoTotalPrivadoCount->total_establecimientos, 'color' => $establecimientoTotalPrivadoCount->color],
                ['nombre' => 'publicos', 'valor' => $establecimientoTotalPublicoCount->total_establecimientos, 'color' => $establecimientoTotalPublicoCount->color],
            ];
        } else {

            $establecimientoTotalPrivadoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                    DB::raw('sector_educativo.color'),
                )
                ->where('sector_educativo.nombre', '=', 'Privado')
                ->first();
            $establecimientoTotalPublicoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                    DB::raw('sector_educativo.color'),
                )
                ->where('sector_educativo.nombre', '=', 'Estatal')
                ->first();

            return [
                ['nombre' => 'privados', 'valor' => $establecimientoTotalPrivadoCount->total_establecimientos, 'color' => $establecimientoTotalPrivadoCount->color],
                ['nombre' => 'publicos', 'valor' => $establecimientoTotalPublicoCount->total_establecimientos, 'color' => $establecimientoTotalPublicoCount->color],
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
