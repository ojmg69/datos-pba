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
                ->where('establecimientos_educativos.distrito_id', '=', $args['idMunicipio'])
                ->first();
                $establecimientoTotalPrivadoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('sector_educativo.nombre', 'Privado')
                ->where('establecimientos_educativos.distrito_id', '=', $args['idMunicipio'])
                ->first();

            $establecimientoTotalPublicoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('sector_educativo.nombre', 'Estatal')
                ->where('establecimientos_educativos.distrito_id', $args['idMunicipio'])
                ->first();
        

            return [
                ['nombre' => 'establecimientos total', 'valor' => $establecimientoTotalCount->total_establecimientos],
                ['nombre' => 'privados', 'valor' => $establecimientoTotalPrivadoCount->total_establecimientos],
                ['nombre' => 'publicos', 'valor' => $establecimientoTotalPublicoCount->total_establecimientos],
            ];
        } else if ($this->tieneArgumento('idSeccion', $args)) {

            $establecimientoTotalCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
            ->join('distritos', 'distritos.id', '=', 'establecimientos_educativos.distrito_id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->first();
            $establecimientoTotalPrivadoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
            ->join('distritos', 'distritos.id', '=', 'establecimientos_educativos.distrito_id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->where('sector_educativo.nombre', '=', 'Privado')
                ->first();
            $establecimientoTotalPublicoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
            ->join('distritos', 'distritos.id', '=', 'establecimientos_educativos.distrito_id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->where('sector_educativo.nombre', '=', 'Estatal')
                ->first();

            return [
                ['nombre' => 'establecimientos total', 'valor' => $establecimientoTotalCount->total_establecimientos],
                ['nombre' => 'privados', 'valor' => $establecimientoTotalPrivadoCount->total_establecimientos],
                ['nombre' => 'publicos', 'valor' => $establecimientoTotalPublicoCount->total_establecimientos],
            ];
        } else {
            $establecimientoTotalCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->first();
            $establecimientoTotalPrivadoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('sector_educativo.nombre', '=', 'Privado')
                ->first();
            $establecimientoTotalPublicoCount = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', '=', 'sector_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('sector_educativo.nombre', '=', 'Estatal')
                ->first();

            return [
                ['nombre' => 'establecimientos total', 'valor' => $establecimientoTotalCount->total_establecimientos],
                ['nombre' => 'privados', 'valor' => $establecimientoTotalPrivadoCount->total_establecimientos],
                ['nombre' => 'publicos', 'valor' => $establecimientoTotalPublicoCount->total_establecimientos],
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
