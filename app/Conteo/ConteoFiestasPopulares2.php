<?php

namespace App\Conteo;

use App\Distrito;
use App\Fiesta;
use Illuminate\Support\Facades\DB;

class ConteoFiestasPopulares2 extends Conteo
{
    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args))
        {

            $countFiestasInternacionales = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
            ->select(
                DB::raw('COUNT(*) as total'),
            )
            ->where('fiestas_tipo.nombre', 'INTERNACIONALES')
            ->where('fiestas.distrito_id', $args['idMunicipio'])
            ->first();

            $countFiestasNacionalesProvinciales = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
            ->select(
                DB::raw('COUNT(*) as total'),
            )
            ->where('fiestas_tipo.nombre', 'NACIONALES / PROVINCIALES')
            ->where('fiestas.distrito_id', $args['idMunicipio'])
            ->first();

            return [
                ['nombre' => 'internacionales', 'valor' => $countFiestasInternacionales->total],
                ['nombre' => 'nacionales / provinciales', 'valor' => $countFiestasNacionalesProvinciales->total],
            ];
        } else if ($this->tieneArgumento('idSeccion', $args))
        {

            $countFiestasInternacionales = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
            ->join('distritos', 'fiestas.distrito_id', 'distritos.id')
            ->select(
                DB::raw('COUNT(*) as total'),
            )
            ->where('fiestas_tipo.nombre', 'INTERNACIONALES')
            ->where('distritos.seccion_id', $args['idSeccion'])
            ->first();

            $countFiestasNacionalesProvinciales = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
            ->join('distritos', 'fiestas.distrito_id', 'distritos.id')
            ->select(
                DB::raw('COUNT(*) as total'),
            )
            ->where('fiestas_tipo.nombre', 'NACIONALES / PROVINCIALES')
            ->where('distritos.seccion_id', $args['idSeccion'])
            ->first();

            return [
                
                ['nombre' => 'internacionales', 'valor' => $countFiestasInternacionales->total],
                ['nombre' => 'nacionales / provinciales', 'valor' => $countFiestasNacionalesProvinciales->total],
            ];
        } else
        {
           

            $countFiestasInternacionales = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
            ->select(
                DB::raw('COUNT(*) as total'),
            )
            ->where('fiestas_tipo.nombre', 'INTERNACIONALES')
            ->first();

            $countFiestasNacionalesProvinciales = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
            ->select(
                DB::raw('COUNT(*) as total'),
            )
            ->where('fiestas_tipo.nombre', 'NACIONALES / PROVINCIALES')
            ->first();

            return [
               
                ['nombre' => 'internacionales', 'valor' => $countFiestasInternacionales->total],
                ['nombre' => 'nacionales / provinciales', 'valor' => $countFiestasNacionalesProvinciales->total],
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
