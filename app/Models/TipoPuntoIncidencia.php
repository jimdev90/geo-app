<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoPuntoIncidencia extends Model
{
    use HasFactory, SoftDeletes;

    const ACTIVO = 1;
    const INACTIVO = 0;

    protected $table = "tipos_puntos_incidencia";
    protected $primaryKey = "";
    protected $fillable = [
        "nombre",
        "estado"
    ];
}
