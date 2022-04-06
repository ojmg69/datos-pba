<?php

namespace App\Conteo;

use App\EstablecimientoSanitario;
use App\CategoriaEstablecimiento;

class ConteoCategoriaSanitario extends Conteo
{

    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args))
        {
            $sanitarioCountQuery = EstablecimientoSanitario::
                selectRaw("count(*)")
                ->where('establecimientos_sanitarios.distrito_id', '=', $args['idMunicipio'])
                ->whereRaw('establecimientos_sanitarios.categorias_establecimientos_id = categorias_establecimientos.id')
                ->getQuery();

            return CategoriaEstablecimiento::
                select('categorias_establecimientos.*')
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
                ->whereRaw('establecimientos_sanitarios.categorias_establecimientos_id = categorias_establecimientos.id')
                ->getQuery();

            return CategoriaEstablecimiento::
                select('categorias_establecimientos.*')
                ->selectSub($sanitarioCountQuery, 'establecimientos_sanitarios_count')
                ->orderBy('establecimientos_sanitarios_count', 'desc')
                ->get();
        } else
        {
            $sanitarioCountQuery =  EstablecimientoSanitario::selectRaw("count(*)")
            ->whereRaw('establecimientos_sanitarios.categorias_establecimientos_id = categorias_establecimientos.id')
            ->getQuery();
            return CategoriaEstablecimiento::
                select('categorias_establecimientos.*')
                ->selectSub($sanitarioCountQuery, 'establecimientos_sanitarios_count')
                ->orderBy('establecimientos_sanitarios_count', 'desc')
                ->get();
        }
    }

    protected function getValorDeCategoria($dato)
    {
        return $dato->establecimientos_sanitarios_count;
    }

    protected function getColorDeCategoriaRestante()
    {
        return '#3E9E2C';
    }
}