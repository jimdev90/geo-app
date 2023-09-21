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
                            <h3>Detalle de punto de incidencia</h3>
                            <smal class="text-primary fw-bold">"{{ $punto->nombre }}"</smal>
                        </div>
                        <ul class="list-group mt-3">
                            <li class="list-group-item">Tipo: <strong>{{ $punto->tipo_punto->nombre }}</strong></li>
                            <li class="list-group-item">Dirección: <strong>{{ $punto->direccion }}</strong></li>
                            <li class="list-group-item">Latitud: <strong>{{ $punto->lat }}</strong></li>
                            <li class="list-group-item">Longitud: <strong>{{ $punto->lng }}</strong></li>
                            <li class="list-group-item">Observaciones: <strong>{{ $punto->observaciones }}</strong></li>
                            <li class="list-group-item">Imagenes:</li>
                            <div class="text-center card card-body">
                                <div class="row">
                                    <div class="col">
                                        @forelse($punto->images as $image)
                                            <div class="img-thumbnail">
                                                <img src="{{ $image->url }}" alt="{{ $punto->nombre }}"
                                                     class="img-thumbnail">
                                            </div>

                                        @empty
                                            <div class="alert alert-danger">
                                                <h3>No se registraron imágenes</h3>
                                            </div>
                                        @endforelse

                                    </div>
                                </div>

                            </div>
                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("scripts_custom")
    <script>

    </script>

@endpush
