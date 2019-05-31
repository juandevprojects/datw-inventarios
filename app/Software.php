<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $table = 'softwares';
    protected $fillable = [ 'descripcion', 'idmarca', 'modelo', 'tpsoft', 'numserie', 'licencia', 'actualizar', 'origen', 'hd', 'observaciones'];
    protected $perPage = 8;
    protected $casts = [ 'actualizar' => 'boolean']; // Esto se usa si quiero utilizar un checkbox para traer y mandar datos desde la base datos

}
