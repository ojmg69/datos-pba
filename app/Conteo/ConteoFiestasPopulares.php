<?php

namespace App\Conteo;

use App\Distrito;
use App\Fiesta;
use Illuminate\Support\Facades\DB;

class ConteoFiestasPopulares extends Conteo
{
    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args))
        {
            $countFiestasNacionales = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
            ->select(
                DB::raw('COUNT(*) as total'),
            )
            ->where('fiestas_tipo.nombre', 'NACIONALES')
            ->where('fiestas.distrito_id', $args['idMunicipio'])
            ->first();

            $countFiestasProvinciales = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
            ->select(
                DB::raw('COUNT(*) as total'),
            )
            ->where('fiestas_tipo.nombre', 'PROVINCIALES')
            ->where('fiestas.distrito_id', $args['idMunicipio'])
            ->first();

            $countFiestasMunicipales = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
            ->select(
                DB::raw('COUNT(*) as total'),
            )
            ->where('fiestas_tipo.nombre', 'MUNICIPALES')
            ->where('fiestas.distrito_id', $args['idMunicipio'])
            ->first();

            return [
                ['nombre' => 'nacionales', 'valor' => $countFiestasNacionales->total],
                ['nombre' => 'provinciales', 'valor' => $countFiestasProvinciales->total],
                ['nombre' => 'municipales', 'valor' => $countFiestasMunicipales->total],
 
            ];
        } else if ($this->tieneArgumento('idSeccion', $args))
        {
            $countFiestasNacionales = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
            ->join('distritos', 'fiestas.distrito_id', 'distritos.id')
            ->select(
                DB::raw('COUNT(*) as total'),
            )
            ->where('fiestas_tipo.nombre', 'NACIONALES')
            ->where('distritos.seccion_id', $args['idSeccion'])
            ->first();

            $countFiestasProvinciales = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
            ->join('distritos', 'fiestas.distrito_id', 'distritos.id')
            ->select(
                DB::raw('COUNT(*) as total'),
            )
            ->where('fiestas_tipo.nombre', 'PROVINCIALES')
            ->where('distritos.seccion_id', $args['idSeccion'])
            ->first();

            $countFiestasMunicipales = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
            ->join('distritos', 'fiestas.distrito_id', 'distritos.id')
            ->select(
                DB::raw('COUNT(*) as total'),
            )
            ->where('fiestas_tipo.nombre', 'MUNICIPALES')
            ->where('distritos.seccion_id', $args['idSeccion'])
            ->first();

        
            return [
                ['nombre' => 'nacionales', 'valor' => $countFiestasNacionales->total],
                ['nombre' => 'provinciales', 'valor' => $countFiestasProvinciales->total],
                ['nombre' => 'municipales', 'valor' => $countFiestasMunicipales->total],
            ];
        } else
        {
            $countFiestasNacionales = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
            ->select(
                DB::raw('COUNT(*) as total'),
            )
            ->where('fiestas_tipo.nombre', 'NACIONALES')
            ->first();

            $countFiestasProvinciales = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
            ->select(
                DB::raw('COUNT(*) as total'),
            )
            ->where('fiestas_tipo.nombre', 'PROVINCIALES')
            ->first();

            $countFiestasMunicipales = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
            ->select(
                DB::raw('COUNT(*) as total'),
            )
            ->where('fiestas_tipo.nombre', 'MUNICIPALES')
            ->first();

            return [
                ['nombre' => 'nacionales', 'valor' => $countFiestasNacionales->total],
                ['nombre' => 'provinciales', 'valor' => $countFiestasProvinciales->total],
                ['nombre' => 'municipales', 'valor' => $countFiestasMunicipales->total],
    
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
