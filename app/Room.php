<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function agenda()
    {
        return $this->hasMany('\App\Agenda');
    }
}
