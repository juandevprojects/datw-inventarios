<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    protected $fillable = ['numero', 'idmarca', 'modelo', 'idubicacion', 'tpmon', 'numserie', 'tamano', 'observaciones', 'tienedvi', 'tienehdmi'];
    protected $perPage = 8;
    protected $casts= [ 'tienedvi' =>'boolean', 'tienehdmi' => 'boolean']; // Esto se usa si quiero utilizar un checkbox para traer y mandar datos desde la base datos
}
