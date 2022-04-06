<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use ConPines;
    
    protected $table = "empresas";

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }
}
