@extends('layouts.app')
@push('css_custom')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css"/>
    <style>
        #map {
            height: 50vh;
            width: 100 hw;
        }

        select {
            width: 30%;
            font-size: 2rem
        }
    </style>
@endpush
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
                            <h3>Registrar punto de incidencia</h3>
                        </div>

                        <form action="{{ route('punto-delictivo.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-2">
                                <label for="id_tipo_punto">Tipo</label>
                                <select name="id_tipo_punto" id="id_tipo_punto" class="form-control">
                                    <option value="">Seleccione...</option>
                                    @foreach($tipos as $tipo)
                                        <option
                                            value="{{ $tipo->id }}" {{ old('id_tipo_punto' == $tipo->id ? 'selected' : '') }}>{{ $tipo->nombre }}</option>
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
                                <input type="text" id="nombre" name="nombre" class="form-control"
                                       value="{{ old('nombre') }}">
                                @error('nombre')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="direccion">Dirección</label>
                                <input type="text" id="direccion" name="direccion" class="form-control"
                                       value="{{ old('direccion') }}">
                                @error('direccion')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2 text-center">
                                <button type="button" class="btn btn-outline-info" id="georef-lugar">Geo-referenciar
                                </button>
                            </div>
                            {{--                            <div id="select-location">--}}
                            {{--                                <select name="location" id="location" class="form-control">--}}
                            {{--                                    <option value="-1">Selecciona uno...</option>--}}
                            {{--                                    <option value="40.748433, -73.985656">Empire State Building</option>--}}
                            {{--                                    <option value="40.689167, -74.044444">Estatua de la Libertad</option>--}}
                            {{--                                    <option value="51.507,0.1275">Londres</option>--}}
                            {{--                                </select>--}}
                            {{--                            </div>--}}
                            <div id="map">

                            </div>
                            <div class="form-group mt-2">
                                <label for="lat">Latitud</label>
                                <input type="text" id="lat" name="lat" class="form-control" value="{{ old('lat') }}" readonly>
                                @error('lat')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="lng">Longitud</label>
                                <input type="text" id="lng" name="lng" class="form-control" value="{{ old('lng') }}" readonly>
                                @error('lng')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="observaciones">Observaciones</label>
                                <textarea name="observaciones" id="observaciones" cols="30" rows="10"
                                          class="form-control">{{ old('observaciones') }}</textarea>
                                @error('observaciones')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="imagen">Foto</label>
                                <input type="file" id="imagen" name="imagen" class="form-control"
                                       value="{{ old('imagen') }}">
                                @error('imagen')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block text-danger">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mt-2 mb-3 text-center">
                                <label for="imagen" class="form-label"></label>
                                <img id="showImage" width="200" class="img-thumbnail"
                                     src="{{ url('images/no_image.jpg') }}"
                                     alt="profile">
                            </div>
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-outline-primary w-100">Registrar</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("scripts_custom")
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
        const RegistrarPuntoDelictivo = function () {

            const _btnGeoRefLugar = $('#georef-lugar');

            const _mostrarImagenCargada = function () {
                $('#imagen').change(function (e) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#showImage').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(e.target.files['0']);
                });
            }

            const _geoReferenciarPunto = function () {
                if (!"geolocation" in navigator) {
                    return alert("Tu navegador no soporta el acceso a la ubicación. Intenta con otro");
                }

                const onUbicacionConcedida = ubicacion => {
                    console.log("Tengo la ubicación: ", ubicacion);
                }

                const onErrorDeUbicacion = error => {
                    console.log("Error obteniendo ubicación: ", error);
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            // El usuario denegó el permiso para la Geolocalización.
                            break;
                        case error.POSITION_UNAVAILABLE:
                            // La ubicación no está disponible.
                            break;
                        case error.TIMEOUT:
                            // Se ha excedido el tiempo para obtener la ubicación.
                            break;
                        case error.UNKNOWN_ERROR:
                            // Un error desconocido.
                            break;
                    }
                }

                const opcionesDeSolicitud = {
                    enableHighAccuracy: true, // Alta precisión
                    maximumAge: 0, // No queremos caché
                    timeout: 5000 // Esperar solo 5 segundos
                };
                // Solicitar
                navigator.geolocation.getCurrentPosition(onUbicacionConcedida, onErrorDeUbicacion, opcionesDeSolicitud);
            }

            _btnGeoRefLugar.on('click', _geoReferenciarPunto)
            return {
                init: function () {
                    _mostrarImagenCargada();
                }
            }
        }()

        $(document).ready(function () {
            RegistrarPuntoDelictivo.init();

            let map = L.map('map').fitWorld();
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution:
                    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            let marker = L.marker([-12.0431800, -77.02824], {
                draggable: true
            }).addTo(map).on('dragend', onDragEnd);

            let geocoder = L.Control.geocoder(),
                latInput = document.getElementById('lat'),
                lngInput = document.getElementById('lng');

            geocoder.markGeocode = function (result) {
                console.log({result})
                var latlng = result.geocode.center;
                map.removeLayer(marker)
                marker = L.marker(latlng, {
                    draggable: true
                }).addTo(map).
                on('dragend', onDragEnd).
                bindPopup(result.geocode.html).
                openPopup();
                map.flyTo(latlng, 18);
                displayLatLng(latlng);
            };

            geocoder.addTo(map)

            function onDragEnd(event) {
                let latlng = event.target.getLatLng();
                map.flyTo(latlng, 18);
                displayLatLng(latlng);
            }
            function displayLatLng(latlng) {
                latInput.value = latlng.lat;
                lngInput.value = latlng.lng;
            }

            // document.getElementById('select-location').addEventListener('change', function(e){
            //     let coords = e.target.value.split(",");
            //     L.marker(coords).addTo(map)
            //     map.flyTo(coords, 18);
            // });
        });
    </script>

@endpush
