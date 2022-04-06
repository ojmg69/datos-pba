<?php

namespace App\Conteo;

use App\Asentamientos;
use App\EstablecimientoSanitario;
use App\TipoEstablecimiento;
use Illuminate\Support\Facades\DB;

class ConteoViviendaAsentamiento extends Conteo
{
    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args))
        {
            $asentamientoTotal = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('asentamientos.distrito_id', '=', $args['idMunicipio'])
            ->first();
            
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

           /* $asentamientoSSTUV = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
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
            ->first();*/


            return [
                ['nombre' => 'asentamientos totales', 'valor' => $asentamientoTotal->total_asentamientos],
                ['nombre' => 'asentamientos precarios', 'valor' => $asentamientoPrecario->total_asentamientos],
                ['nombre' => "ㅤtotal de ㅤㅤㅤvillasㅤㅤ", 'valor' => $asentamientoVilla->total_asentamientos],
             /*   ['nombre' => 'con intervención sstuv', 'valor' => $asentamientoSSTUV->total_asentamientos],
                ['nombre' => 'urbanizaciones planificadas', 'valor' => $asentamientoPlanificadas->total_asentamientos],
                ['nombre' => 'otros', 'valor' => $asentamientoOtros->total_asentamientos] */
            ];
        } else if ($this->tieneArgumento('idSeccion', $args))
        {
            $asentamientoTotal = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->join('distritos', 'asentamientos.distrito_id', '=', 'distritos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->where('distritos.seccion_id', '=', $args['idSeccion'])
            ->first();
            
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

          /*  $asentamientoSSTUV = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
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
            ->first(); */


            return [
                ['nombre' => 'asentamientos totales', 'valor' => $asentamientoTotal->total_asentamientos],
                ['nombre' => 'asentamientos precarios', 'valor' => $asentamientoPrecario->total_asentamientos],
                ['nombre' => 'ㅤtotal de ㅤㅤㅤvillasㅤㅤ', 'valor' => $asentamientoVilla->total_asentamientos],
             /*   ['nombre' => 'con intervención sstuv', 'valor' => $asentamientoSSTUV->total_asentamientos],
                ['nombre' => 'urbanizaciones planificadas', 'valor' => $asentamientoPlanificadas->total_asentamientos],
                ['nombre' => 'otros', 'valor' => $asentamientoOtros->total_asentamientos] */
            ];
        } else
        {
            $asentamientoTotal = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
            ->select(
                DB::raw('count(asentamientos.tipo_asentamientos_id) as total_asentamientos'),
            )
            ->first();
            
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

          /*  $asentamientoSSTUV = Asentamientos::join('tipo_asentamientos', 'asentamientos.tipo_asentamientos_id', 'tipo_asentamientos.id')
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
            ->first(); */


            return [
                ['nombre' => 'asentamientos totales', 'valor' => $asentamientoTotal->total_asentamientos],
                ['nombre' => 'asentamientos precarios', 'valor' => $asentamientoPrecario->total_asentamientos],
                ['nombre' => 'ㅤtotal de ㅤㅤㅤvillasㅤㅤ', 'valor' => $asentamientoVilla->total_asentamientos],
               /* ['nombre' => 'con intervención sstuv', 'valor' => $asentamientoSSTUV->total_asentamientos],
                ['nombre' => 'urbanizaciones planificadas', 'valor' => $asentamientoPlanificadas->total_asentamientos],
                ['nombre' => 'otros', 'valor' => $asentamientoOtros->total_asentamientos]*/
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
