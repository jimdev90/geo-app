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
                            <h3>Gestionar Imagenes del punto de incidencia</h3>
                            <smal class="text-primary fw-bold">"{{ $punto->nombre }}"</smal>

                        </div>
                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-outline-dark" id="abrir-modal-cargar-imagenes">
                                Cargar Imagen
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                @forelse($punto->images as $image)
                                    <div class="img-thumbnail">
                                        <img src="{{ $image->url }}" alt="{{ $punto->nombre }}" class="img-thumbnail">
                                        <a href="{{ route('punto-delictivo.delete-images', ['imagen' => $image->id]) }}"
                                           class="btn btn-outline-danger mt-1 w-100 eliminar-imagen">Eliminar</a>
                                    </div>

                                @empty
                                    <div class="alert alert-danger">
                                        <h3>No se registraron imágenes</h3>
                                    </div>
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAgregarImagenes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('punto-delictivo.store-images') }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" name="id_punto_delictivo" value="{{ $punto->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Imágenes</h5>
                        <button type="button" class="close btn cerrar-modal-cargar-imagenes" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
                                 src="{{ asset('images/no_image.jpg') }}"
                                 alt="profile">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary cerrar-modal-cargar-imagenes">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push("scripts_custom")
    <script>

        const PuntoDelictivoGestionarImagenes = function () {

            const _btnAbrirModalCargarImagenes = $('#abrir-modal-cargar-imagenes')
            const _cerrarModalCargarImagenes = $('.cerrar-modal-cargar-imagenes')
            const _modalAgregarImagenes = $('#modalAgregarImagenes')

            const _gestionarModals = function () {
                _btnAbrirModalCargarImagenes.on('click', function () {
                    _modalAgregarImagenes.modal('show')
                })

                _cerrarModalCargarImagenes.on('click', function () {
                    _modalAgregarImagenes.modal('hide')
                })
            }

            const _mostrarImagenPrevia = function () {
                $('#imagen').change(function (e) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#showImage').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(e.target.files['0']);
                });
            }

            const _eliminarImagen = function () {
                $('body').on('click', '.eliminar-imagen', function (event) {
                    event.preventDefault();
                    let deleteUrl = $(this).attr('href')
                    console.log(deleteUrl)
                    Swal.fire({
                        title: 'Atención!',
                        text: '¿Deseas eliminar la imagen seleccionada?',
                        showDenyButton: true,
                        confirmButtonText: 'Si',
                        denyButtonText: `No`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.axios({
                                method: 'DELETE',
                                url: deleteUrl
                            }).then((res) => {
                                console.log(res)
                                const {data} = res;
                                if (data.status === 'success') {
                                    Swal.fire(
                                        'Eliminado!',
                                        data.message,
                                        'success'
                                    )
                                    window.location.reload();
                                } else if (data.status === 'error') {
                                    Swal.fire(
                                        'Oops!',
                                        data.message,
                                        'error'
                                    )
                                }
                            })
                        } else if (result.isDenied) {
                            Swal.fire('Acción cancelada', '', 'success')
                        }
                    })
                })
            }

            return {
                init: function () {
                    _gestionarModals();
                    _mostrarImagenPrevia();
                    _eliminarImagen();
                }
            }
        }()

        $(document).ready(function () {
            PuntoDelictivoGestionarImagenes.init()


            // Swal.fire({
            //     title: 'Atención!',
            //     text: 'Para poder realizar el registro, es necesario dar permisos de ubicación para poder geo-referenciar el lugar del punto a registrar!!. ¿Desea continuar?',
            //     showDenyButton: true,
            //     confirmButtonText: 'Si',
            //     denyButtonText: `No`,
            // }).then((result) => {
            //     /* Read more about isConfirmed, isDenied below */
            //     if (result.isConfirmed) {
            //         // Swal.fire('Confirmado!', 'Ahora puede continuar con el registro')
            //         getLocalizacion()
            //     } else if (result.isDenied) {
            //         // Swal.fire('Changes are not saved', '', 'info')
            //     }
            // })
            //
            // const getLocalizacion = () => {
            //     if (!"geolocation" in navigator) {
            //         return alert("Tu navegador no soporta el acceso a la ubicación. Intenta con otro");
            //     }
            //
            //     const onUbicacionConcedida = ubicacion => {
            //         console.log("Tengo la ubicación: ", ubicacion);
            //     }
            //
            //     const onErrorDeUbicacion = err => {
            //         console.log("Error obteniendo ubicación: ", err);
            //     }
            //
            //     const opcionesDeSolicitud = {
            //         enableHighAccuracy: true, // Alta precisión
            //         maximumAge: 0, // No queremos caché
            //         timeout: 5000 // Esperar solo 5 segundos
            //     };
            //     // Solicitar
            //     navigator.geolocation.getCurrentPosition(onUbicacionConcedida, onErrorDeUbicacion, opcionesDeSolicitud);
            //
            // };


        });
    </script>

    @if( session()->has('registrarImagenPunto') )
        <script>
            $(function () {
                $('#modalAgregarImagenes').modal('show');
            });
        </script>
    @endif

@endpush
