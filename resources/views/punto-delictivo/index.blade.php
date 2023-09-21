@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <a class="btn btn-success" href="{{ route('punto-delictivo.create') }}">
                            Registrar punto +
                        </a>
                        <div class="alert alert-success mt-3">
                            <p>Cantidad de puntos registrados</p>
                            <strong>{{ count($puntos) }}</strong>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @forelse($puntos as $punto)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $punto->nombre }}</td>
                                    <td>{{ $punto->direccion }}</td>
                                    <td>
                                        <a href="{{ route('punto-delictivo.show', ['punto' => $punto]) }}" class="btn btn-outline-info btn-sm w-100" title="Ver detalle"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('punto-delictivo.edit', ['punto' => $punto]) }}" class="btn btn-outline-warning btn-sm w-100 mt-1" title="Editar"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('punto-delictivo.edit-images', ['punto' => $punto]) }}" class="btn btn-outline-success btn-sm w-100 mt-1" title="Editar images"><i class="fa fa-image"></i></a>
                                        <a href="{{ route('punto-delictivo.delete', ['punto' => $punto]) }}" class="btn btn-outline-danger btn-sm w-100 mt-1 eliminar-punto-delictivo" title="Eliminar"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Sin registros</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_custom')
    <script>
        const BandejaPuntosDelictivos = function () {

            const _eliminarPunto = function () {
                $('body').on('click', '.eliminar-punto-delictivo', function (event) {
                    event.preventDefault();
                    let deleteUrl = $(this).attr('href')
                    console.log(deleteUrl)
                    Swal.fire({
                        title: 'Atención!',
                        text: '¿Deseas eliminar el punto seleccionado?',
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
                    _eliminarPunto()
                }
            }
        }();
        $(document).ready(function () {
            BandejaPuntosDelictivos.init();
        })
    </script>
@endpush

