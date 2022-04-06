<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniversidadOTerciario extends Model
{
    use ConPines;

    protected $table = "universidad_o_terciario";

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }
}
