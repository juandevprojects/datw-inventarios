<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raton extends Model
{
    protected $fillable = ['numero', 'idmarca', 'modelo', 'idubicacion', 'tpraton', 'numserie', 'observaciones'];
    protected $perPage = 8;
}
