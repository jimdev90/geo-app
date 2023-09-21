<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPuntoIncidencia extends Model
{
    use HasFactory;

    const ACTIVO = 1;
    const INACTIVO = 0;

    protected $table = "tipos_puntos_incidencia";
    protected $fillable = [
        "nombre",
        "estado"
    ];
}
