<?php

namespace App\Conteo;

use App\EstablecimientoSanitario;
use App\TipoEstablecimiento;

class ConteoTipoSanitario extends Conteo
{
    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args))
        {
            $sanitarioCountQuery = EstablecimientoSanitario::
                selectRaw("count(*)")
                ->where('establecimientos_sanitarios.distrito_id', '=', $args['idMunicipio'])
                ->whereRaw('establecimientos_sanitarios.tipos_establecimientos_id = tipos_establecimientos.id')
                ->getQuery();

            return TipoEstablecimiento::
                select('tipos_establecimientos.*')
                ->selectSub($sanitarioCountQuery, 'establecimientos_sanitarios_count')
                ->orderBy('establecimientos_sanitarios_count', 'desc')
                ->get();
        } else if ($this->tieneArgumento('idSeccion', $args))
        {
            $sanitarioCountQuery = EstablecimientoSanitario::
                join('distritos', 'establecimientos_sanitarios.distrito_id', '=', 'distritos.id')
                ->join('secciones', 'distritos.seccion_id', '=', 'secciones.id')
                ->selectRaw("count(*)")
                ->where('secciones.id', '=', $args['idSeccion'])
                ->whereRaw('establecimientos_sanitarios.tipos_establecimientos_id = tipos_establecimientos.id')
                ->getQuery();

            return TipoEstablecimiento::
                select('tipos_establecimientos.*')
                ->selectSub($sanitarioCountQuery, 'establecimientos_sanitarios_count')
                ->orderBy('establecimientos_sanitarios_count', 'desc')
                ->get();
        } else
        {
            $sanitarioCountQuery = EstablecimientoSanitario::selectRaw("count(*)")
                ->whereRaw('establecimientos_sanitarios.tipos_establecimientos_id = tipos_establecimientos.id')
                ->getQuery();
            return TipoEstablecimiento::
                select('tipos_establecimientos.*')
                ->selectSub($sanitarioCountQuery, 'establecimientos_sanitarios_count')
                ->orderBy('establecimientos_sanitarios_count', 'desc')
                ->get();
        }
    }

    protected function getValorDeCategoria($dato)
    {
        return $dato->establecimientos_sanitarios_count;
    }

    protected function getColorDeCategoria($dato)
    {
        return null;
    }
}
