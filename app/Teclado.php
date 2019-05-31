<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teclado extends Model
{
    protected $fillable = ['numero', 'idmarca', 'modelo', 'idubicacion', 'tptec', 'numserie', 'observaciones'];
    protected $perPage = 8;
}
