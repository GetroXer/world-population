<?php

namespace GetroXer\WorldPopulation\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
Use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class WorldPopulation extends Model
{

    protected $table = 'world_population';

    protected $fillable = [
        'name',
        'code',
        'year',
        'value',
    ];

    protected $hidden = [
    ];

}
