<?php

namespace App\Conteo;

use App\Departamento;
use App\Sede;
use Illuminate\Support\Facades\DB;

class ConteoTribunalesJuzgadosGrafica extends Conteo
{

    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {

            $camarasYJuzgados = Sede::join('judicial_pantalla', 'sedes.judicial_pantalla_id', 'judicial_pantalla.id')
                ->select(
                    DB::raw('count(*) as total_camaras_juzgados')
                )
                ->where('judicial_pantalla.nombre', 'Cámaras y Juzgados')
                ->where('sedes.distrito_id', '=', $args['idMunicipio'])
                ->first();

            $juzgadoDePaz = Sede::join('judicial_pantalla', 'sedes.judicial_pantalla_id', 'judicial_pantalla.id')
                ->select(
                    DB::raw('count(*) as total_juzgado_paz')
                )
                ->where('judicial_pantalla.nombre', 'Juzgados de Paz')
                ->where('sedes.distrito_id', '=', $args['idMunicipio'])
                ->first();

            return [
                ['nombre' => 'camaras y juzgados', 'valor' => $camarasYJuzgados->total_camaras_juzgados, 'colores' => '#4C9BF3'],
                ['nombre' => 'juzgado de paz', 'valor' => $juzgadoDePaz->total_juzgado_paz, 'colores' => '#FCF404']
            ];
        } else if ($this->tieneArgumento('idSeccion', $args)) {

            $camarasYJuzgados = Sede::join('judicial_pantalla', 'sedes.judicial_pantalla_id', 'judicial_pantalla.id')
                ->join('distritos', 'sedes.distrito_id', 'distritos.id')
                ->select(
                    DB::raw('count(*) as total_camaras_juzgados')
                )
                ->where('judicial_pantalla.nombre', 'Cámaras y Juzgados')
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->first();

            $juzgadoDePaz = Sede::join('judicial_pantalla', 'sedes.judicial_pantalla_id', 'judicial_pantalla.id')
                ->join('distritos', 'sedes.distrito_id', 'distritos.id')
                ->select(
                    DB::raw('count(*) as total_juzgado_paz')
                )
                ->where('judicial_pantalla.nombre', 'Juzgados de Paz')
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->first();

            return [
                ['nombre' => 'camaras y juzgados', 'valor' => $camarasYJuzgados->total_camaras_juzgados, 'colores' => '#4C9BF3'],
                ['nombre' => 'juzgado de paz', 'valor' => $juzgadoDePaz->total_juzgado_paz, 'colores' => '#FCF404']
            ];
        } else {

            $camarasYJuzgados = Sede::join('judicial_pantalla', 'sedes.judicial_pantalla_id', 'judicial_pantalla.id')
                ->select(
                    DB::raw('count(*) as total_camaras_juzgados')
                )
                ->where('judicial_pantalla.nombre', 'Cámaras y Juzgados')
                ->first();

            $juzgadoDePaz = Sede::join('judicial_pantalla', 'sedes.judicial_pantalla_id', 'judicial_pantalla.id')
                ->select(
                    DB::raw('count(*) as total_juzgado_paz')
                )
                ->where('judicial_pantalla.nombre', 'Juzgados de Paz')
                ->first();

            return [
                ['nombre' => 'camaras y juzgados', 'valor' => $camarasYJuzgados->total_camaras_juzgados, 'colores' => '#4C9BF3'],
                ['nombre' => 'juzgado de paz', 'valor' => $juzgadoDePaz->total_juzgado_paz, 'colores' => '#FCF404']
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
        return $dato['colores'];
    }
}
