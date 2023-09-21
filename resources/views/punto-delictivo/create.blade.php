@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-success" href="{{ route('home') }}">
                            BANDEJA
                        </a>
                    </div>

                    <div class="card-body">


                        <form action="{{ route('punto-delictivo.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-2">
                                <label for="id_tipo_punto">Tipo</label>
                                <select name="id_tipo_punto" id="id_tipo_punto" class="form-control">
                                    <option value="">Seleccione...</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
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
                                <input type="text" id="nombre" name="nombre" class="form-control">
                                @error('nombre')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="direccion">Dirección</label>
                                <input type="text" id="direccion" name="direccion" class="form-control">
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
                                <input type="text" id="lat" name="lat" class="form-control" readonly>
                                @error('lat')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="lng">Longitud</label>
                                <input type="text" id="lng" name="lng" class="form-control" readonly>
                                @error('lng')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="observaciones">Observaciones</label>
                                <textarea name="observaciones" id="observaciones" cols="30" rows="10" class="form-control"></textarea>
                                @error('observaciones')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="imagen">Foto</label>
                                <input type="file" id="imagen" name="imagen" class="form-control">
                                @error('imagen')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <button class="btn btn-outline-primary w-100">Registrar</button>
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

            Swal.fire({
                title: 'Atención!',
                text: 'Para poder realizar el registro, es necesario dar permisos de ubicación para poder geo-referenciar el lugar del punto a registrar!!. ¿Desea continuar?',
                showDenyButton: true,
                confirmButtonText: 'Si',
                denyButtonText: `No`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire('Confirmado!', 'Ahora puede continuar con el registro')
                } else if (result.isDenied) {
                    // Swal.fire('Changes are not saved', '', 'info')
                }
            })
        });
    </script>

@endpush
