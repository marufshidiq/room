<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 'listrik', 'ac', 'proyektor', 'key', 'ip_address', 'last_update'
    ];

    public function agenda()
    {
        return $this->hasMany('\App\Agenda');
    }
}
