<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PuntoDelictivo extends Model
{
    use HasFactory, SoftDeletes;
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
        "estado",
        "user_create",
    ];

    public function tipo_punto(): BelongsTo
    {
        return $this->belongsTo(TipoPuntoIncidencia::class, 'id_tipo_punto', 'id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PuntoDelictivoImage::class, 'id_punto_delictivo', 'id');
    }
}
