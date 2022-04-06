<?php

namespace App\Conteo;

use App\Organismo;
use App\TipoOrganismo;

class ConteoOrganismoNacionalProvincial extends Conteo
{

    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {
            $organismoNacionalCount = TipoOrganismo::leftJoin('organismos_provinciales_nacionales', 'organismos.id', '=', 'organismos_provinciales_nacionales.organismo_id')
                ->selectRaw('count(*) as organismos_nacionales, organismos.color, organismos.tipo')
                ->where('organismos_provinciales_nacionales.distrito_id', '=', $args['idMunicipio'])
                ->where('organismos.tipo', '=', 'Nacional')
                ->groupBy('organismos.id')
                ->orderBy('organismos_nacionales', 'desc')
                ->get();

            $organismoProvincialCount = TipoOrganismo::leftJoin('organismos_provinciales_nacionales', 'organismos.id', '=', 'organismos_provinciales_nacionales.organismo_id')
                ->selectRaw('count(*) as organismos_provinciales, organismos.color, organismos.tipo')
                ->where('organismos_provinciales_nacionales.distrito_id', '=', $args['idMunicipio'])
                ->where('organismos.tipo', '=', 'Provincial')
                ->groupBy('organismos.id')
                ->orderBy('organismos_provinciales', 'desc')
                ->get();

            $countNationalAll = 0;
            $countProvincialAll = 0;

            $organismoNacionalCountAll = $organismoNacionalCount->map(function ($item) use ($countNationalAll) {
                $countNationalAll += $item['organismos_nacionales'];
                return $countNationalAll;
            });

            $organismoProvincialCountAll = $organismoProvincialCount->map(function ($item) use ($countProvincialAll) {
                $countProvincialAll += $item['organismos_provinciales'];
                return $countProvincialAll;
            });

            return [
                ['nombre' => 'nacional', 'valor' => array_sum($organismoNacionalCountAll->toArray())],
                ['nombre' => 'provincial', 'valor' => array_sum($organismoProvincialCountAll->toArray())],
            ];
        } else {
            $organismoNacionalCount = TipoOrganismo::leftJoin('organismos_provinciales_nacionales', 'organismos.id', '=', 'organismos_provinciales_nacionales.organismo_id')
                ->selectRaw('count(*) as organismos_nacionales, organismos.color, organismos.tipo')
                ->where('organismos.tipo', '=', 'Nacional')
                ->groupBy('organismos.id')
                ->orderBy('organismos_nacionales', 'desc')
                ->get();

            $organismoProvincialCount = TipoOrganismo::leftJoin('organismos_provinciales_nacionales', 'organismos.id', '=', 'organismos_provinciales_nacionales.organismo_id')
                ->selectRaw('count(*) as organismos_provinciales, organismos.color, organismos.tipo')
                ->where('organismos.tipo', '=', 'Provincial')
                ->groupBy('organismos.id')
                ->orderBy('organismos_provinciales', 'desc')
                ->get();

            $countNationalAll = 0;
            $countProvincialAll = 0;

            $organismoNacionalCountAll = $organismoNacionalCount->map(function ($item) use ($countNationalAll) {
                $countNationalAll += $item['organismos_nacionales'];
                return $countNationalAll;
            });

            $organismoProvincialCountAll = $organismoProvincialCount->map(function ($item) use ($countProvincialAll) {
                $countProvincialAll += $item['organismos_provinciales'];
                return $countProvincialAll;
            });

            return [
                ['nombre' => 'nacional', 'valor' => array_sum($organismoNacionalCountAll->toArray())],
                ['nombre' => 'provincial', 'valor' => array_sum($organismoProvincialCountAll->toArray())],
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
