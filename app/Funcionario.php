<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = "funcionarios";

    public function ministerio()
    {
        return $this->belongsTo('App\Ministerio');
    }


    public static function cantidadSubsecretarias(){
        $resultado = Funcionario::where('funcionarios.cargo', 'like', 'subsecretar%')->count();
        return $resultado;
    }

    public static function cantidadMinistras(){
        $resultado = Funcionario::where('funcionarios.cargo', 'like', 'ministra%')->count();
        return $resultado;
    }

    public static function cantidadMinistros(){
        $resultado = Funcionario::where('funcionarios.cargo', 'like', 'ministro%')->count();
        return $resultado;
    }
}
