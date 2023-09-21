@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <a class="btn btn-success" href="{{ route('punto-delictivo.index') }}">
                            <i class="fa fa-list"></i> Bandeja
                        </a>
                    </div>

                    <div class="card-body">

                        <div class="text-center">
                            <h3>Editar punto de incidencia</h3>
                            <smal class="text-primary fw-bold">"{{ $punto->nombre }}"</smal>
                        </div>
                        <form action="{{ route('punto-delictivo.update', ['punto' => $punto]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input name="id" type="hidden" class="form-control" value="{{ $punto->id }}">
                            <div class="form-group mt-2">
                                <label for="id_tipo_punto">Tipo</label>
                                <select name="id_tipo_punto" id="id_tipo_punto" class="form-control">
                                    <option value="">Seleccione...</option>
                                    @foreach($tipos as $tipo)
                                        <option
                                            value="{{ $tipo->id }}"
                                            {{ $punto->id_tipo_punto == $tipo->id ? 'selected' : '' }}
                                        >{{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_tipo_punto')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', $punto->nombre) }}">
                                @error('nombre')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="direccion">Dirección</label>
                                <input type="text" id="direccion" name="direccion" class="form-control" value="{{ old('direccion', $punto->direccion) }}">
                                @error('direccion')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2 text-center">
                                <button class="btn btn-outline-info">Geo-referenciar</button>
                            </div>
                            <div class="form-group mt-2">
                                <label for="lat">Latitud</label>
                                <input type="text" id="lat" name="lat" class="form-control" value="{{ old('lat', $punto->lat) }}">
                                @error('lat')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="lng">Longitud</label>
                                <input type="text" id="lng" name="lng" class="form-control" value="{{ old('lng', $punto->lng) }}">
                                @error('lng')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="observaciones">Observaciones</label>
                                <textarea name="observaciones" id="observaciones" cols="30" rows="10" class="form-control">{{ old('observaciones', $punto->observaciones) }}</textarea>
                                @error('observaciones')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-outline-primary w-100">Editar</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("scripts_custom")
    <script>
        $(document).ready(function () {

        });
    </script>

@endpush
