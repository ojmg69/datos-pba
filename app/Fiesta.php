<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fiesta extends Model
{
    protected $table = "fiestas";

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }
    
}
