<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PuntoDelictivoImage extends Model
{
    use HasFactory, SoftDeletes;
    const ACTIVO = 1;
    const INACTIVO = 0;

    protected $table = "puntos_delictivo_images";
    protected $fillable = [
        "id_punto_delictivo",
        "url",
        "user_create",
    ];
}
