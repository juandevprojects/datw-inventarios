<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Impresora extends Model
{
    protected $fillable = ['numero', 'idmarca', 'modelo', 'idubicacion', 'tpimpresora', 'numserie', 'red', 'memoria', 'serie', 'usb', 'wifi', 'paralelo', 'ethernet', 'observaciones'];
    protected $perPage = 8;
    protected $casts = [ 'serie' => 'boolean', 'usb' => 'boolean', 'wifi' => 'boolean', 'paralelo' => 'boolean', 'ethernet' => 'boolean']; // Esto se usa si quiero utilizar un checkbox para traer y mandar datos desde la base datos
}
