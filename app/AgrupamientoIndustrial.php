<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgrupamientoIndustrial extends Model
{
    use ConPines;
    
    protected $table = "agrupamiento_industriales";

    public function pymes() {
        return $this->hasMany('App\Pyme');
    }
}
