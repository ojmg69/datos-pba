<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organismo extends Model
{
    use ConPines;
    
    protected $table = 'organismos_provinciales_nacionales';

    public function organismo()
    {
        return $this->belongsTo('App\TipoOrganismo');
    }

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }

/*     public function autoridades()
    {
        return $this->hasMany('App\OrganismoAutoridad');
    } */
}
