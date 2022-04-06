<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegionEducativa extends Model
{
    use ConReferencias;

    protected $table = "regiones_educativas";
    
    public function distritos() {
        return $this->hasMany('App\Distrito');
    }
}