<?php

namespace App\Http\Controllers;

use App\Http\Requests\PuntoDelictivoImageRequest;
use App\Models\PuntoDelictivoImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PuntoDelictivoImageController extends Controller
{
    public function store(PuntoDelictivoImageRequest $request)
    {
        $file =  $request->file('imagen')->store('public/puntos-delictivos');
        $url = Storage::url($file);

        PuntoDelictivoImage::create([
            "id_punto_delictivo" => $request->id_punto_delictivo,
            "url" => $url,
            "user_create" => auth()->user()->cip
        ]);

        toastr('Imagen registrada correctamente!!');
        return redirect()->back();
    }

    public function delete(PuntoDelictivoImage $imagen)
    {
        $imagen->delete();
        return response(['status' => 'success', 'message' => 'Imagen eliminada con éxito!']);

    }
}
