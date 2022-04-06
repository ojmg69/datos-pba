<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puerto extends Model
{
    use ConPines;

    protected $table = "puertos";

    public function distrito() {
        return $this->hasOne('App\Distrito');
    }
}
