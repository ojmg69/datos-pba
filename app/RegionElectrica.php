<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegionElectrica extends Model
{
    protected $table = "region_electrica";
    
    public function distritos() {
        return $this->hasMany('App\Distrito');
    }
}