<?php

namespace App\Conteo;

use App\Asentamientos;
use App\EstablecimientoSanitario;
use App\TipoEstablecimiento;
use Illuminate\Support\Facades\DB;

class ConteoViviendaAsentamientoGrafico extends Conteo
{
    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args))
        {            
            $asentamientoPrecario = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('asentamientos.distrito_id', '=', $args['idMunicipio'])
            ->where('tipo_asentamientos.nombre', 'Asentamiento Precario')
            ->first();

            $asentamientoVilla = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('asentamientos.distrito_id', '=', $args['idMunicipio'])
            ->where('tipo_asentamientos.nombre', 'Villa')
            ->first();

            $asentamientoSSTUV = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('asentamientos.distrito_id', '=', $args['idMunicipio'])
            ->where('tipo_asentamientos.nombre', 'Barrio con intervención SSTUV')
            ->first();

            $asentamientoPlanificadas = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('asentamientos.distrito_id', '=', $args['idMunicipio'])
            ->where('tipo_asentamientos.nombre', 'Urbanizaciones planificadas')
            ->first();
            
            $asentamientoOtros = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('asentamientos.distrito_id', '=', $args['idMunicipio'])
            ->where('tipo_asentamientos.nombre', 'Otros')
            ->first();


            return [
                ['nombre' => 'asentamientos precarios', 'valor' => $asentamientoPrecario->total_asentamientos, 'color' => '#B51D82'],
                ['nombre' => 'villas', 'valor' => $asentamientoVilla->total_asentamientos, 'color' => '#865CAB'],
                ['nombre' => 'barrios con intervención sstuv', 'valor' => $asentamientoSSTUV->total_asentamientos, 'color' => '#E11921'],
                ['nombre' => 'urbanizaciones planificadas', 'valor' => $asentamientoPlanificadas->total_asentamientos, 'color' => '#A10511'],
                ['nombre' => 'otros', 'valor' => $asentamientoOtros->total_asentamientos, 'color' => '#d7d7d7']
            ];
        } else if ($this->tieneArgumento('idSeccion', $args))
        {
            
            $asentamientoPrecario = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->join('distritos', 'asentamientos.distrito_id', '=', 'distritos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('distritos.seccion_id', '=', $args['idSeccion'])
            ->where('tipo_asentamientos.nombre', 'Asentamiento Precario')
            ->first();

            $asentamientoVilla = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->join('distritos', 'asentamientos.distrito_id', '=', 'distritos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('distritos.seccion_id', '=', $args['idSeccion'])
            ->where('tipo_asentamientos.nombre', 'Villa')
            ->first();

            $asentamientoSSTUV = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->join('distritos', 'asentamientos.distrito_id', '=', 'distritos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('distritos.seccion_id', '=', $args['idSeccion'])
            ->where('tipo_asentamientos.nombre', 'Barrio con intervención SSTUV')
            ->first();

            $asentamientoPlanificadas = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->join('distritos', 'asentamientos.distrito_id', '=', 'distritos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('distritos.seccion_id', '=', $args['idSeccion'])
            ->where('tipo_asentamientos.nombre', 'Urbanizaciones planificadas')
            ->first();
            
            $asentamientoOtros = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->join('distritos', 'asentamientos.distrito_id', '=', 'distritos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('distritos.seccion_id', '=', $args['idSeccion'])
            ->where('tipo_asentamientos.nombre', 'Otros')
            ->first();


            return [
                ['nombre' => 'asentamientos precarios', 'valor' => $asentamientoPrecario->total_asentamientos, 'color' => '#B51D82'],
                ['nombre' => 'villas', 'valor' => $asentamientoVilla->total_asentamientos, 'color' => '#865CAB'],
                ['nombre' => 'barrios con intervención sstuv', 'valor' => $asentamientoSSTUV->total_asentamientos, 'color' => '#E11921'],
                ['nombre' => 'urbanizaciones planificadas', 'valor' => $asentamientoPlanificadas->total_asentamientos, 'color' => '#A10511'],
                ['nombre' => 'otros', 'valor' => $asentamientoOtros->total_asentamientos, 'color' => '#d7d7d7']
            ];
        } else
        {            
            $asentamientoPrecario = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('tipo_asentamientos.nombre', 'Asentamiento Precario')
            ->first();

            $asentamientoVilla = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('tipo_asentamientos.nombre', 'Villa')
            ->first();

            $asentamientoSSTUV = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('tipo_asentamientos.nombre', 'Barrio con intervención SSTUV')
            ->first();

            $asentamientoPlanificadas = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('tipo_asentamientos.nombre', 'Urbanizaciones planificadas')
            ->first();
            
            $asentamientoOtros = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('tipo_asentamientos.nombre', 'Otros')
            ->first();


            return [
                ['nombre' => 'asentamientos precarios', 'valor' => $asentamientoPrecario->total_asentamientos, 'color' => '#B51D82'],
                ['nombre' => 'villas', 'valor' => $asentamientoVilla->total_asentamientos, 'color' => '#865CAB'],
                ['nombre' => 'barrios con intervención sstuv', 'valor' => $asentamientoSSTUV->total_asentamientos, 'color' => '#E11921'],
                ['nombre' => 'urbanizaciones planificadas', 'valor' => $asentamientoPlanificadas->total_asentamientos, 'color' => '#A10511'],
                ['nombre' => 'otros', 'valor' => $asentamientoOtros->total_asentamientos, 'color' => '#d7d7d7']
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
