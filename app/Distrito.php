<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class Distrito extends Model
{
    protected $table = "distritos";


    /************************* Inicio pivotes geografía **************************/
    public function climas()
    {
        return $this->belongsToMany('App\Clima')->withTimestamps();
    }

    public function cultivosFaunas()
    {
        return $this->belongsToMany('App\Cultivo_Fauna')->withTimestamps();
    }

    public function cuencas()
    {
        return $this->belongsToMany('App\Cuenca')->withTimestamps();
    }

    public function rios()
    {
        return $this->belongsToMany('App\Rio')->withTimestamps();
    }

    public function suelos()
    {
        return $this->belongsToMany('App\Suelo')->withTimestamps();
    }

    public function vientos()
    {
        return $this->belongsToMany('App\Viento')->withTimestamps();
    }

    public function zonasHidricas()
    {
        return $this->belongsToMany('App\ZonaHidrica')->withTimestamps();
    }
    /************************* Fin pivotes geografía ***************************/



    public function PlanesPolitico()
    {
        return $this->belongsToMany('App\PlanPolitico')->withTimestamp();
    }


    public function region_educativa()
    {
        return $this->belongsTo('App\RegionEducativa');
    }

    public function region_electrica()
    {
        return $this->belongsTo('App\RegionElectrica');
    }

    public function servicio_agua()
    {
        return $this->hasOne('App\ServicioAgua');
    }

    public function servicio_conectividad()
    {
        return $this->hasOne('App\ServicioConectividad');
    }

    public function intendente()
    {
        return $this->hasOne('App\Intendente');
    }

    public function departamento()
    {
        return $this->belongsTo('App\Departamento');
    }

    public function seccion()
    {
        return $this->belongsTo('App\Seccion');
    }

    public function concejales()
    {
        return $this->hasMany('App\ConcejoDeliberante');
    }

    public function organismos()
    {
        return $this->hasMany('App\Organismo');
    }

    public function consulados()
    {
        return $this->hasMany('App\Consulado');
    }

    public function fiestas()
    {
        return $this->hasMany('App\Fiestas');
    }

    public function asentamientos()
    {
        return $this->hasMany('App\Asentamientos');
    }
    public function servicios()
    {
        return $this->hasMany('App\Servicio');
    }

    public function transferencias()
    {
        return $this->hasMany('App/Transferencia');
    }

    public function electores()
    {
        return $this->hasMany('App\Elector');
    }

    public function resultadosElectorales()
    {
        return $this->hasMany('App\ResultadosElectorales');
    }

    public function regiones_sanitarias()
    {
        return $this->belongsToMany('App\RegionSanitaria', 'distrito_reg_sanitarias')
            ->withTimestamps();
    }

    public function comisarias_mujer()
    {
        return $this->hasMany('App\ComisariaMujer');
    }

    public function espacios_contecnion()
    {
        return $this->hasMany('App\EspacioContencion');
    }


    /*********************** Estilos para pintar Regiones ***********************/
    public static function estilosSegunRegionElectrica()
    {
        $resultado = [];

        $distritos = Distrito::all();

        foreach ($distritos as $distrito) {
            $region = $distrito->region_electrica;
            if (!is_null($region)) {
                $estilo = [
                    'id'        => $distrito->id,
                    'relleno'   => $region->color
                ];
                array_push($resultado, $estilo);
            }
        }
        return $resultado;
    }

    public static function estilosSegunRegionEducativa()
    {
        $resultado = [];

        $distritos = Distrito::all();

        foreach ($distritos as $distrito) {
            $region = $distrito->region_educativa;
            if (!is_null($region)) {
                $estilo = [
                    'id'        => $distrito->id,
                    'relleno'   => $region->color
                ];
                array_push($resultado, $estilo);
            }
        }
        return $resultado;
    }

    public static function estilosSegunRegionSanitaria()
    {
        $resultado = [];

        $distritos = Distrito::all();

        foreach ($distritos as $distrito) {
            $regiones = $distrito->regiones_sanitarias;
            if (!is_null($regiones) && !is_null($regiones[0])) {
                $estilo = [
                    'id'        => $distrito->id,
                    'relleno'   => $regiones[0]->color_seccion
                ];
                array_push($resultado, $estilo);
            }
        }
        return $resultado;
    }

    public static function estilosSegunBloqueMayoritario()
    {
        $resultado = [];

        $distritos = Distrito::all();

        foreach ($distritos as $distrito) {
            $bloque = Distrito::bloqueConMasConcejales($distrito->id);
            if (!is_null($bloque)) {
                $estilo = [
                    'id'        => $distrito->id,
                    'relleno'   => $bloque->color
                ];
                array_push($resultado, $estilo);
            }
        }
        return $resultado;
    }

    public static function estilosSegunDepartamentoJudicial()
    {
        $distritos = Distrito::join('departamentos', 'distritos.departamento_id', '=', 'departamentos.id')
            ->select('distritos.*', 'departamentos.color')
            ->get();
        $estilos = [];
        foreach ($distritos as $municipio) {
            $estilo = [
                'id'        => intval($municipio->id),
                'relleno'   => $municipio->departamento->color
            ];
            array_push($estilos, $estilo);
        }
        return $estilos;
    }

    public static function estilosSegunClima($ClimaAPintar)
    {

        $distritos = Distrito::join('clima_distrito', 'distritos.id', '=', 'clima_distrito.distrito_id')
            ->join('climas', 'clima_distrito.clima_id', '=', 'climas.id')
            ->select("distritos.*", "climas.id as clima_id", "climas.color")
            ->where('climas.id', '=', $ClimaAPintar)
            ->get();

        $estilos = [];

        foreach ($distritos as $municipio) {
            $estilo = [
                'id'        => intval($municipio->id),
                'relleno'   => $municipio->color
            ];
            array_push($estilos, $estilo);
        }
        return $estilos;
    }

    public static function estilosSegunSuelo($ClimaAPintar)
    {

        $distritos = Distrito::join('distrito_suelo', 'distritos.id', '=', 'distrito_suelo.distrito_id')
            ->join('suelos', 'distrito_suelo.suelo_id', '=', 'suelos.id')
            ->select("distritos.*", "suelos.id as suelo_id", "suelos.color")
            ->where('suelos.id', '=', $ClimaAPintar)
            ->get();

        $estilos = [];

        foreach ($distritos as $municipio) {
            $estilo = [
                'id'        => intval($municipio->id),
                'relleno'   => $municipio->color
            ];
            array_push($estilos, $estilo);
        }
        return $estilos;
    }

    public static function estilosSegunViento($VientoAPintar)
    {

        $distritos = Distrito::join('distrito_viento', 'distritos.id', '=', 'distrito_viento.distrito_id')
            ->join('vientos', 'distrito_viento.viento_id', '=', 'vientos.id')
            ->select("distritos.*", "vientos.id as viento_id", "vientos.color")
            ->where('vientos.id', '=', $VientoAPintar)
            ->get();

        $estilos = [];

        foreach ($distritos as $municipio) {
            $estilo = [
                'id'        => intval($municipio->id),
                'relleno'   => $municipio->color
            ];
            array_push($estilos, $estilo);
        }
        return $estilos;
    }


    public static function estilosSegunZonaHidraulicas($VientoAPintar)
    {

        $distritos = Distrito::join('distrito_zona_hidrica', 'distritos.id', '=', 'distrito_zona_hidrica.distrito_id')
            ->join('zona_hidricas', 'distrito_zona_hidrica.zona_hidrica_id', '=', 'zona_hidricas.id')
            ->select("distritos.*", "zona_hidricas.id as zona_hidrica_id", "zona_hidricas.color")
            ->where('zona_hidricas.id', '=', $VientoAPintar)
            ->get();

        $estilos = [];

        foreach ($distritos as $municipio) {
            $estilo = [
                'id'        => intval($municipio->id),
                'relleno'   => $municipio->color
            ];
            array_push($estilos, $estilo);
        }
        return $estilos;
    }

    public static function estilosSegunPlan($PlanAPintar)
    {
        $distritos = Distrito::join('distrito_plan_politico', 'distritos.id', '=', 'distrito_plan_politico.distrito_id')
            ->join('planes_politicos', 'distrito_plan_politico.planes_politicos_id', '=', 'planes_politicos.id')
            ->select("distritos.*", "planes_politicos.id as plan_politico", "planes_politicos.color", "distrito_plan_politico.observaciones as observaciones")
            ->where('planes_politicos.id','=',$PlanAPintar)
            ->where('distrito_plan_politico.observaciones', '!=', "Sin información")
            ->where('observaciones', 'not like', 'No posee')
            ->where('observaciones', 'not like', 'No adhiere')
            ->get();

        $estilos = [];
        foreach ($distritos as $municipio) {
            $estilo = [
                'id' => intval(($municipio->id)),
                'relleno' => $municipio->color
            ];
            array_push($estilos, $estilo);
        }
        return $estilos;
    }


    /***********************************************************************************/
    /************************** Funciones personalizadas  ******************************/
    /***********************************************************************************/

    /**
     * Devuelve el bloque con mayor cantidad de concejales dentro
     * de un municipio. Si dos o mas bloques tienen la misma cantidad
     * de concejales, devuelve null.
     */
    private static function bloqueConMasConcejales($distritoId)
    {
        $consulta = Bloque::rightJoin('concejo_deliberantes', 'concejo_deliberantes.bloque_id', '=', 'bloques.id')
            ->leftJoin('distritos', 'concejo_deliberantes.distrito_id', '=', 'distritos.id')
            ->select('bloques.*', Db::raw('count(bloques.id) as concejales'))
            ->where('distritos.id', '=', $distritoId)
            ->orderBy(DB::raw('count(bloques.id)'), 'DESC')
            ->groupBy('bloques.id')
            ->take(2);

        $bloques = $consulta->get();

        if (count($bloques) > 1) {
            return $bloques[0]->concejales > $bloques[1]->concejales
                ? $bloques[0]
                : null;
        } else if (count($bloques) == 1) {
            return $bloques[0];
        } else {
            return null;
        }
    }
}
