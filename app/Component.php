<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $fillable = ['numero', 'idmarca', 'modelo', 'idubicacion', 'tpcomp', 'numserie', 'observaciones'];
    protected $perPage = 8;
}
