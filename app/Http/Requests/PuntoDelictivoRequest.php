<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PuntoDelictivoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()){
            case 'PUT':
                return [
                    "id" => ["required", Rule::exists('puntos_delictivo','id')],
                    "id_tipo_punto" => ["required", Rule::exists('tipos_puntos_incidencia', 'id')],
                    "nombre" => ["required" , "string"],
                    "direccion" => ["required", "string"],
                    "lat" => ["required",],
                    "lng" => ["required"],
                    "observaciones" => ["required", "string"],
                    "imagen" => ["nullable", "file", "mimes:jpg,png,jpeg"],
                ];
            case 'POST':
                return [
                    "id_tipo_punto" => ["required", Rule::exists('tipos_puntos_incidencia', 'id')],
                    "nombre" => ["required" , "string"],
                    "direccion" => ["required", "string"],
                    "lat" => ["required",],
                    "lng" => ["required"],
                    "observaciones" => ["required", "string"],
                    "imagen" => ["required", "file", "mimes:jpg,png,jpeg"],
                ];
        }

    }

    public function attributes()
    {
        return [
            "id_tipo_punto" => "tipo",
            "lat" => "latitud",
            "lng" => "longitud",
        ];
    }
}
