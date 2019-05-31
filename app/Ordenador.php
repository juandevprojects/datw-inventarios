<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordenador extends Model
{
    protected $fillable = ['numero', 'idmarca', 'modelo', 'idubicacion', 'tppc', 'numserie', 'red', 'maclan', 'iplan', 'macwifi', 'ipwifi', 'hd1', 'hd2', 'observaciones'];
    protected $perPage = 8;
}
