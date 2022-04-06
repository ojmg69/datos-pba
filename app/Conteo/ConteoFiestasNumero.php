<?php

namespace App\Conteo;

use App\Fiesta;
use Illuminate\Support\Facades\DB;

class ConteoFiestasNumero extends Conteo
{

    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idMunicipio', $args)) {
            $fiestasCount = FiestasPopulares::join('distritos', 'fiestas.distrito_id', '=', 'distritos.id')
                ->select(
                    DB::raw('count(*) as total_fiestas'),
                )
                ->where('fiestas.distrito_id', '=', $args['idMunicipio'])
                ->first();
            
            return [
                ['nombre' => 'fiestas', 'valor' => $fiestasCount->total_fiestas],
            ];
        } else {
            $fiestasCount = FiestasPopulares::join('distritos', 'fiestas.distrito_id', '=', 'distritos.id')
                ->select(
                    DB::raw('count(*) as total_fiestas'),
                )
                ->first();

            return [
                ['nombre' => 'fiestas', 'valor' => $fiestasCount->total_fiestas],
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
