<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ministerio extends Model
{
    protected $table = 'ministerios';

    public function funcionarios()
    {
        return $this->hasMany('App\Funcionario');
    }

    public static function cantidadMinisterios(){
        $resultado = Ministerio::where('ministerios.nombre', 'like', 'Ministerio%')->count();
        return $resultado;
    }

    // public static function cantidadSubsecretarias(){

    // }
}
