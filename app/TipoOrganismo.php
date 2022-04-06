<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoOrganismo extends Model
{
    use ConReferencias;
    
    protected $table = 'organismos';
    
    public function organismos()
    {
        return $this->hasMany('App\Organismo');
    }

    public function autoridades()
    {
        return $this->hasMany('App\OrganismoAutoridad');
    }

}
