<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoDelictivo extends Model
{
    use HasFactory;
    protected $table = "puntos_delictivo";

    const ACTIVO = 1;
    const INACTIVO = 0;
    protected $fillable = [
        "id_tipo_punto",
        "nombre",
        "direccion",
        "lat",
        "lng",
        "observaciones",
        "imagen",
    ];
}
