<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Electores extends Model
{
    protected $table = "electores";

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }
    
}
