<?php

namespace App\Conteo;

use App\Fiesta;
use App\Distrito;
use Illuminate\Support\Facades\DB;

class ConteoFiestasTipo extends Conteo
{

    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {

            $fiestasTipoMunicipalesCount = FiestasPopulares::join('fiestas_tipo', 'fiestas.tipo', '=', 'fiestas_tipo.id')
                ->select(
                    DB::raw('count(*) as total_fiestas')
                )
                ->where('fiestas_tipo.nombre', '=', 'MUNICIPALES')
                ->where('fiestas.distrito_id', '=', $args['idMunicipio'])
                ->first();
                
            $fiestasTipoProvincialesCount = FiestasPopulares::join('fiestas_tipo', 'fiestas.tipo', '=', 'fiestas_tipo.id')
                ->select(
                    DB::raw('count(*) as total_fiestas')
                )
                ->where('fiestas_tipo.nombre', '=', 'POVINCIALES')
                ->where('fiestas.distrito_id', '=', $args['idMunicipio'])
                ->first();

             $fiestasTipoNacionalesCount = FiestasPopulares::join('fiestas_tipo', 'fiestas.tipo', '=', 'fiestas_tipo.id')
                ->select(
                    DB::raw('count(*) as total_fiestas')
                )
                ->where('fiestas_tipo.nombre', '=', 'NACIONALES')
                ->where('fiestas.distrito_id', '=', $args['idMunicipio'])
                ->first();

            return [
                ['nombre' => 'municipales', 'valor' => $fiestasTipoMunicipalesCount
                    ->total_fiestas],
                 ['nombre' => 'provinciales', 'valor' => $fiestasTipoProvincialesCount
                    ->total_fiestas],
                 ['nombre' => 'nacionales', 'valor' => $fiestasTipoNacionalesCount
                    ->total_fiestas],
            ];
        } else if ($this->tieneArgumento('idSeccion', $args)) {
            $fiestasTipoMunicipalesCount = 
                  FiestasPopulares::join('fiestas_tipo', 'fiestas.tipo', '=', 'fiestas_tipo.id')
                ->join('distritos', 'distritos.id', '=', 'fiestas.distrito_id')
                ->select(
                    DB::raw('count(*) as total_fiestas')
                )
                ->where('fiestas_tipo.nombre', '=', 'MUNICIPALES')
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->first();

             $fiestasTipoProvincialesCount = 
                  FiestasPopulares::join('fiestas_tipo', 'fiestas.tipo', '=', 'fiestas_tipo.id')
                ->join('distritos', 'distritos.id', '=', 'fiestas.distrito_id')
                ->select(
                    DB::raw('count(*) as total_fiestas')
                )
                ->where('fiestas_tipo.nombre', '=', 'PROVINCIALES')
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->first();

             $fiestasTipoNacionalesCount = 
                  FiestasPopulares::join('fiestas_tipo', 'fiestas.tipo', '=', 'fiestas_tipo.id')
                ->join('distritos', 'distritos.id', '=', 'fiestas.distrito_id')
                ->select(
                    DB::raw('count(*) as total_fiestas')
                )
                ->where('fiestas_tipo.nombre', '=', 'NACIONALES')
                ->where('distritos.seccion_id', '=', $args['idSeccion'])
                ->first();

            return [
                ['nombre' => 'municipales', 'valor' => empty($ $fiestasTipoMunicipalesCount
                 ->total_fiestas) ? 0 : 
                     $fiestasTipoMunicipalesCount
                     ->total_fiestas],
                 ['nombre' => 'provinciales', 'valor' => empty($ $fiestasTipoProvincialesCount
                 ->total_fiestas) ? 0 : 
                     $fiestasTipoProvincialesCount
                     ->total_fiestas],
                  ['nombre' => 'nacionales', 'valor' => empty($ $fiestasTipoNacionalesCount
                 ->total_fiestas) ? 0 : 
                     $fiestasTiponacionalesCount
                     ->total_fiestas],
            ];
        } else {
            $fiestasTipoMunicipalesCount
               = FiestasPopulares::join('fiestas_tipo', 'fiestas.tipo', '=', 'fiestas_tipo.id')
                ->select(
                    DB::raw('count(*) as total_fiestas')
                )
                ->where('fiestas_tipo.nombre', '=', 'MUNICIPALES')
                ->first();
                
              $fiestasTipoProvincialesCount
               = FiestasPopulares::join('fiestas_tipo', 'fiestas.tipo', '=', 'fiestas_tipo.id')
                ->select(
                    DB::raw('count(*) as total_fiestas')
                )
                ->where('fiestas_tipo.nombre', '=', 'PROVINCIALES')
                ->first();

             $fiestasTipoNacionalesCount
               = FiestasPopulares::join('fiestas_tipo', 'fiestas.tipo', '=', 'fiestas_tipo.id')
                ->select(
                    DB::raw('count(*) as total_fiestas')
                )
                ->where('fiestas_tipo.nombre', '=', 'NACIONALES')
                ->first();

            return [
                ['nombre' => 'municipales', 'valor' => $fiestasTipoMunicipalesCount
                   ->total_fiestas],
                ['nombre' => 'provinciales', 'valor' => $fiestasTipoProvincialesCount
                ->total_fiestas],
                ['nombre' => 'nacionales', 'valor' => $fiestasTipoNacionalesCount
                ->total_fiestas]
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
