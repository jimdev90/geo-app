<?php

namespace App\Http\Controllers;

use App\Models\PuntoDelictivo;
use App\Models\TipoPuntoIncidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PuntoDelictivoController extends Controller
{
    public function create()
    {
        $tipos = TipoPuntoIncidencia::where('estado', 1)->get();
        return view('punto-delictivo.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "id_tipo_punto" => ["required"],
            "nombre" => ["required" , "string"],
            "direccion" => ["required", "string"],
            "lat" => ["required",],
            "lng" => ["required"],
            "observaciones" => ["required", "string"],
            "imagen" => ["required", "file", "mimes:jpg,png,jpeg"],
        ]);

        $file =  $request->file('file')->store('public/puntos-delictivos');
        $url = Storage::url($file);

        PuntoDelictivo::create([
            "id_tipo_punto" => $request->id_tipo_punto,
            "nombre" => $request->nombre,
            "direccion" => $request->direccion,
            "lat" => $request->lat,
            "lng" => $request->lng,
            "observaciones" => $request->observaciones,
            "imagen" => $url,
        ]);

        toastr("Registro exitoso!!!");
        return redirect()->route('home');
    }
}
