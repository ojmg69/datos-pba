<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intendente extends Model
{
    protected $table = "intendentes";
    /* protected $fillable = ['']; */

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }

    public function partido()
    {
        return $this->belongsTo('App\Partido');
    }
}
