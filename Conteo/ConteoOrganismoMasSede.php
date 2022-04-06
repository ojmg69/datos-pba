<?php

namespace App\Conteo;

use App\Organismo;
use App\TipoOrganismo;

class ConteoOrganismoMasSede extends Conteo
{

    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args))
        {
            $organismoCount = Organismo::
                selectRaw("count(*)")
                ->where('organismos_provinciales_nacionales.distrito_id', '=', $args['idMunicipio'])
                ->whereRaw('organismos_provinciales_nacionales.organismo_id = organismos.id')
                ->getQuery();

            return TipoOrganismo::
                select('organismos.*')
                ->selectSub($organismoCount, 'conteo_organismos_count')
                ->orderBy('conteo_organismos_count', 'desc')
                ->get();
        } else
        {
            $organismoCount =  Organismo::selectRaw("count(*)")
            ->whereRaw('organismos_provinciales_nacionales.organismo_id = organismos.id')
            ->getQuery();
            return TipoOrganismo::
                select('organismos.*')
                ->selectSub($organismoCount, 'conteo_organismos_count')
                ->orderBy('conteo_organismos_count', 'desc')
                ->get();
        }
    }

    protected function getNombreDeCategoria($dato)
    {
        return $dato['nombre'];
    }

    protected function getValorDeCategoria($dato)
    {
        return $dato->conteo_organismos_count;
    }

    protected function getColorDeCategoriaRestante()
    {
        return '#3E9E2C';
    }
}