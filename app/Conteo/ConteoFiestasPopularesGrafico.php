<?php

namespace App\Conteo;

use App\Distrito;
use App\Fiesta;
use Illuminate\Support\Facades\DB;

class ConteoFiestasPopularesGrafico extends Conteo
{
    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {
            $countFiestasTotal = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
                ->select(
                    DB::raw('COUNT(*) as total'),
                )
                ->where('fiestas.distrito_id', $args['idMunicipio'])
                ->first();

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

            $countFiestasNacionales = $countFiestasNacionales->total != 0 ? ($countFiestasNacionales->total / $countFiestasTotal->total) * 100 : 0;
            $countFiestasProvinciales = $countFiestasProvinciales->total != 0 ? ($countFiestasProvinciales->total / $countFiestasTotal->total) * 100 : 0;
            $countFiestasMunicipales = $countFiestasMunicipales->total != 0 ? ($countFiestasMunicipales->total / $countFiestasTotal->total) * 100 : 0;
            $countFiestasInternacionales = $countFiestasInternacionales->total != 0 ? ($countFiestasInternacionales->total / $countFiestasTotal->total) * 100 : 0;
            $countFiestasNacionalesProvinciales = $countFiestasNacionalesProvinciales->total != 0 ? ($countFiestasNacionalesProvinciales->total / $countFiestasTotal->total) * 100 : 0;

            return [
                ['nombre' => 'nacionales', 'valor' => number_format($countFiestasNacionales, 2), 'color' => '#153AA5'],
                ['nombre' => 'provinciales', 'valor' => number_format($countFiestasProvinciales, 2), 'color' => '#17A2B8'],
                ['nombre' => 'municipales', 'valor' => number_format($countFiestasMunicipales, 2), 'color' => '#6F8EEC'],
                ['nombre' => 'internacionales', 'valor' => number_format($countFiestasInternacionales, 2), 'color' => '#db7800'],
                ['nombre' => 'nacionales / provinciales', 'valor' => number_format($countFiestasNacionalesProvinciales, 2), 'color' => '#6D16A6'],
            ];
        } else if ($this->tieneArgumento('idSeccion', $args)) {
            $countFiestasTotal = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
                ->join('distritos', 'fiestas.distrito_id', 'distritos.id')
                ->select(
                    DB::raw('COUNT(*) as total'),
                )
                ->where('distritos.seccion_id', $args['idSeccion'])
                ->first();

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

            $countFiestasNacionales = $countFiestasNacionales->total != 0 ? ($countFiestasNacionales->total / $countFiestasTotal->total) * 100 : 0;
            $countFiestasProvinciales = $countFiestasProvinciales->total != 0 ? ($countFiestasProvinciales->total / $countFiestasTotal->total) * 100 : 0;
            $countFiestasMunicipales = $countFiestasMunicipales->total != 0 ? ($countFiestasMunicipales->total / $countFiestasTotal->total) * 100 : 0;
            $countFiestasInternacionales = $countFiestasInternacionales->total != 0 ? ($countFiestasInternacionales->total / $countFiestasTotal->total) * 100 : 0;
            $countFiestasNacionalesProvinciales = $countFiestasNacionalesProvinciales->total != 0 ? ($countFiestasNacionalesProvinciales->total / $countFiestasTotal->total) * 100 : 0;

            return [
                ['nombre' => 'nacionales', 'valor' => number_format($countFiestasNacionales, 2), 'color' => '#153AA5'],
                ['nombre' => 'provinciales', 'valor' => number_format($countFiestasProvinciales, 2), 'color' => '#17A2B8'],
                ['nombre' => 'municipales', 'valor' => number_format($countFiestasMunicipales, 2), 'color' => '#6F8EEC'],
                ['nombre' => 'internacionales', 'valor' => number_format($countFiestasInternacionales, 2), 'color' => '#db7800'],
                ['nombre' => 'nacionales / provinciales', 'valor' => number_format($countFiestasNacionalesProvinciales, 2), 'color' => '#6D16A6'],
            ];
        } else {
            $countFiestasTotal = Fiesta::join('fiestas_tipo', 'fiestas.tipo_id', 'fiestas_tipo.id')
                ->select(
                    DB::raw('COUNT(*) as total'),
                )
                ->first();

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

            $countFiestasNacionales = $countFiestasNacionales->total != 0 ? ($countFiestasNacionales->total / $countFiestasTotal->total) * 100 : 0;
            $countFiestasProvinciales = $countFiestasProvinciales->total != 0 ? ($countFiestasProvinciales->total / $countFiestasTotal->total) * 100 : 0;
            $countFiestasMunicipales = $countFiestasMunicipales->total != 0 ? ($countFiestasMunicipales->total / $countFiestasTotal->total) * 100 : 0;
            $countFiestasInternacionales = $countFiestasInternacionales->total != 0 ? ($countFiestasInternacionales->total / $countFiestasTotal->total) * 100 : 0;
            $countFiestasNacionalesProvinciales = $countFiestasNacionalesProvinciales->total != 0 ? ($countFiestasNacionalesProvinciales->total / $countFiestasTotal->total) * 100 : 0;

            return [
                ['nombre' => 'nacionales', 'valor' => number_format($countFiestasNacionales, 2), 'color' => '#153AA5'],
                ['nombre' => 'provinciales', 'valor' => number_format($countFiestasProvinciales, 2), 'color' => '#17A2B8'],
                ['nombre' => 'municipales', 'valor' => number_format($countFiestasMunicipales, 2), 'color' => '#6F8EEC'],
                ['nombre' => 'internacionales', 'valor' => number_format($countFiestasInternacionales, 2), 'color' => '#db7800'],
                ['nombre' => 'nacionales / provinciales', 'valor' => number_format($countFiestasNacionalesProvinciales, 2), 'color' => '#6D16A6'],
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
