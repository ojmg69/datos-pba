<?php

namespace App\Conteo;

use App\EstablecimientoEducativo;
use Illuminate\Support\Facades\DB;

class conteoClasificacionNiveles extends Conteo
{

    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {
            $establecimientoInicialTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Inicial')
                ->where('establecimientos_educativos.distrito_id', '=', $args['idMunicipio'])
                ->first();
            $establecimientoPrimarioTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Primaria / Secundaria')
                ->where('establecimientos_educativos.distrito_id', '=', $args['idMunicipio'])
                ->first();
            $establecimientoUniversitarioTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Superior')
                ->where('establecimientos_educativos.distrito_id', '=', $args['idMunicipio'])
                ->first();
            $establecimientoOtrosTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Otros')
                ->where('establecimientos_educativos.distrito_id', '=', $args['idMunicipio'])
                ->first();

            return [
                ['nombre' => 'inicial', 'valor' => $establecimientoInicialTotalCount->total_establecimientos],
                ['nombre' => 'primario / secundario', 'valor' => $establecimientoPrimarioTotalCount->total_establecimientos],
                ['nombre' => 'superior', 'valor' => $establecimientoUniversitarioTotalCount->total_establecimientos],
                ['nombre' => 'otros', 'valor' => $establecimientoOtrosTotalCount->total_establecimientos],
            ];
        } else if ($this->tieneArgumento('idSeccion', $args)) {

            $establecimientoInicialTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->join('distritos', 'distritos.id', '=', 'establecimientos_educativos.distrito_id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Inicial')
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->first();
            $establecimientoPrimarioTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->join('distritos', 'distritos.id', '=', 'establecimientos_educativos.distrito_id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Primaria / Secundaria')
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->first();
            $establecimientoUniversitarioTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->join('distritos', 'distritos.id', '=', 'establecimientos_educativos.distrito_id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Superior')
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->first();
            $establecimientoOtrosTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->join('distritos', 'distritos.id', '=', 'establecimientos_educativos.distrito_id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Otros')
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->first();

            return [
                ['nombre' => 'inicial', 'valor' => $establecimientoInicialTotalCount->total_establecimientos],
                ['nombre' => 'primario / secundario', 'valor' => $establecimientoPrimarioTotalCount->total_establecimientos],
                ['nombre' => 'superior', 'valor' => $establecimientoUniversitarioTotalCount->total_establecimientos],
                ['nombre' => 'otros', 'valor' => $establecimientoOtrosTotalCount->total_establecimientos],
            ];
        } else {
            $establecimientoInicialTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Inicial')
                ->first();
            $establecimientoPrimarioTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Primaria / Secundaria')
                ->first();
            $establecimientoUniversitarioTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Superior')
                ->first();
            $establecimientoOtrosTotalCount = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->select(
                    DB::raw('count(*) as total_establecimientos'),
                )
                ->where('tipo_establecimiento_educativo.nombre', 'Otros')
                ->first();

            return [
                ['nombre' => 'inicial', 'valor' => $establecimientoInicialTotalCount->total_establecimientos],
                ['nombre' => 'primario / secundario', 'valor' => $establecimientoPrimarioTotalCount->total_establecimientos],
                ['nombre' => 'superior', 'valor' => $establecimientoUniversitarioTotalCount->total_establecimientos],
                ['nombre' => 'otros', 'valor' => $establecimientoOtrosTotalCount->total_establecimientos],
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
