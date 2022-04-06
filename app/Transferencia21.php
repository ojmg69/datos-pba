<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    protected $table = 'transferencias21';

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }
}
