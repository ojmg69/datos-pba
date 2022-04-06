<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    protected $table = 'transferencias';

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }
}
