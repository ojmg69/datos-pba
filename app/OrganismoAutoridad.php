<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganismoAutoridad extends Model
{
    
    protected $table = "organismo_autoridades";
    
    public function organismo()
    {
        return $this->belongsTo('App\TipoOrganismo');
    }
}
