<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dispred extends Model
{
    protected $fillable = ['numero', 'idmarca', 'modelo', 'idubicacion', 'tpdisp', 'numserie', 'red', 'maclan', 'iplan', 'observaciones'];
    protected $perPage = 8;
}
