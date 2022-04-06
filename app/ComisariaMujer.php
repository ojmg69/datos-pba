<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComisariaMujer extends Model
{
    use ConPines;

    protected $table = "comisarias_mujer";

    public function distrito() {
        return $this->belongsTo('App\Distrito');
    }
}
