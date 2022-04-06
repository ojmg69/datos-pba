<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConcejoDeliberante extends Model
{
    protected $table = 'concejo_deliberantes';

  /*   protected $fillable = [
        'concejal', 'mandato_inicio', 'mandato_fin', 'color', 'bloque_id', 'distrito_id', 'descripcion', 'estado'
    ]; */

    public $timestamps = false;

    public function bloque()
    {
        return $this->belongsTo('App\Bloque');
    }

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }
}
