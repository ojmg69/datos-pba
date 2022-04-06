<?php

namespace App\Conteo;

use App\Intendente;
use App\Partido;

/**
 * Representa un conteo de la cantidad de intendentes de cada partido, ordenado de mayor a menor.
 */
class ConteoDePartidos extends Conteo
{
    public $withCities;
    public function __construct($withCities = false)
    {
        $this->withCities = $withCities;
    }
    /**
     * $args :: [ idSeccion => int ] | null
     */
    protected function cargarDatos($args = null)
    {
        if ($this->tieneArgumento('idSeccion', $args)) {
            $intendentesCountQuery = Intendente::join('distritos', 'intendentes.distrito_id', '=', 'distritos.id')
                ->join('secciones', 'distritos.seccion_id', '=', 'secciones.id')
                ->selectRaw("count(*)")
                ->where('secciones.id', '=', $args['idSeccion'])
                ->whereRaw('intendentes.partido_id = partidos.id')
                ->getQuery();

            return Partido::select('partidos.*')
                // ->wherehas('intendentes.distrito', function ($query) {
                //     $query->where('switch', '=', 1);
                // })
                ->selectSub($intendentesCountQuery, 'intendentes_count')
                ->orderBy('intendentes_count', 'desc')
                ->get();
        } else {
            $sql = Partido::orderBy('intendentes_count', 'desc');
            if(!$this->withCities){
                $sql->withCount(['intendentes' => function($query){
                    $query->wherehas('distrito', function ($query) {
                        $query->where('switch', '=', 1);
                    });
                }]);
            }else{
                $sql->withCount('intendentes');
            }
            return $sql->get();
        }
    }

    protected function getValorDeCategoria($dato)
    {
        return $dato->intendentes_count;
    }

    protected function getNombreDeCategoriaRestante()
    {
        return 'Partidos Vecinales';
    }

    protected function getColorDeCategoriaRestante()
    {
        return '#3E9E2C';
    }
}
