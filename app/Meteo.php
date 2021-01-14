<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meteo extends Model
{
    protected $fillable = [
        'temperature', 'humidite'
    ];
}
