<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParqueEolico extends Model
{
    use ConPines;
    
    protected $table = "parques_eolicos";

    public function distrito() {
        return $this->hasOne('App\Distrito');
    }
}
