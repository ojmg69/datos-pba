<?php

namespace App\Conteo;

use App\Departamento;
use App\Http\Livewire\TablaSedes;
use App\Sede;
use Illuminate\Support\Facades\DB;

class ConteoTribunalesJuzgados extends Conteo
{

    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {

            $departamentosJudiciales = Departamento::join('distritos', 'departamentos.id', 'distritos.departamento_id')
                ->select(
                    DB::raw('departamentos.nombre')
                )
                ->where('distritos.id', '=', $args['idMunicipio'])
                ->get();

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
                ['nombre' => 'departamentos judiciales', 'valor' => count($departamentosJudiciales)],
                ['nombre' => 'cámaras y juzgados', 'valor' => $camarasYJuzgados->total_camaras_juzgados],
                ['nombre' => 'juzgado de paz', 'valor' => $juzgadoDePaz->total_juzgado_paz]
            ];
        } else if ($this->tieneArgumento('idSeccion', $args)) {

            $departamentosJudiciales = Departamento::join('distritos', 'departamentos.id', 'distritos.departamento_id')
                ->select(
                    DB::raw('departamentos.nombre')
                )
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->groupBy("departamentos.nombre")
                ->havingRaw("COUNT(departamentos.nombre) >= 1")
                ->get();

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
                ['nombre' => 'departamentos judiciales', 'valor' => count($departamentosJudiciales)],
                ['nombre' => 'cámaras y juzgados', 'valor' => $camarasYJuzgados->total_camaras_juzgados],
                ['nombre' => 'juzgado de paz', 'valor' => $juzgadoDePaz->total_juzgado_paz]
            ];
        } else {
            $departamentosJudiciales = Departamento::select(
                DB::raw('COUNT(departamentos.nombre) count')
            )
            ->havingRaw("COUNT(departamentos.nombre) > 1")
            ->first();

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
                ['nombre' => 'departamentos judiciales', 'valor' => $departamentosJudiciales->count],
                ['nombre' => 'cámaras y juzgados', 'valor' => $camarasYJuzgados->total_camaras_juzgados],
                ['nombre' => 'juzgado de paz', 'valor' => $juzgadoDePaz->total_juzgado_paz]
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
