<?php

namespace App\Http\Controllers;

use App\Http\Requests\PuntoDelictivoRequest;
use App\Models\PuntoDelictivo;
use App\Models\PuntoDelictivoImage;
use App\Models\TipoPuntoIncidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;

class PuntoDelictivoController extends Controller
{
    public function index()
    {

        $puntos = PuntoDelictivo::where('user_create', auth()->user()->idusuarios)->get();

        return view('punto-delictivo.index', compact('puntos'));
    }
    public function create()
    {
        $tipos = TipoPuntoIncidencia::orderBy('nombre', 'asc')->get();
        return view('punto-delictivo.create', compact('tipos'));
    }

    public function store(PuntoDelictivoRequest $request)
    {
        try {
            DB::beginTransaction();

            $punto = PuntoDelictivo::create([
                "id_tipo_punto" => $request->id_tipo_punto,
                "nombre" => $request->nombre,
                "direccion" => $request->direccion,
                "lat" => $request->lat,
                "lng" => $request->lng,
                "observaciones" => $request->observaciones,
                "user_create" => auth()->user()->idusuarios
            ]);

            $file =  $request->file('imagen')->store('public/puntos-delictivos');
            $url = Storage::url($file);

            PuntoDelictivoImage::create([
                "id_punto_delictivo" => $punto->id,
                "url" => $url,
                "user_create" => auth()->user()->idusuarios
            ]);

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            toastr()->error('Ha ocurrido un error');
            return redirect()->back()->withInput($request->all());
//            return $exception;
        }
        toastr("Registro exitoso!!!");
        return redirect()->route('punto-delictivo.index');
    }

    public function show(PuntoDelictivo $punto)
    {
        return view('punto-delictivo.show', compact('punto'));
    }

    public function edit(PuntoDelictivo $punto)
    {
        $tipos = TipoPuntoIncidencia::orderBy('nombre', 'asc')->get();
        return view('punto-delictivo.edit', compact('punto', 'tipos'));
    }

    public function update(PuntoDelictivoRequest $request, PuntoDelictivo $punto)
    {
        $punto->id_tipo_punto = $request->id_tipo_punto;
        $punto->nombre = $request->nombre;
        $punto->direccion = $request->direccion;
        $punto->lat = $request->lat;
        $punto->lng = $request->lng;
        $punto->observaciones = $request->observaciones;
        $punto->save();
        toastr("El punto {$punto->nombre} se ha actualizado correctamente");
        return redirect()->route('punto-delictivo.index');
    }

    public function editImages(PuntoDelictivo $punto)
    {

        return view('punto-delictivo.edit-images', compact('punto'));
    }
    public function delete(PuntoDelictivo $punto)
    {
        $punto->delete();
        return response(['status' => 'success', 'message' => 'Punto eliminado con éxito!']);
    }
}
