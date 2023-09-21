@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <div class="alert alert-success mt-3">
                        <h2>Hola {{ auth()->user()->name }}</h2>
                    </div>
                </div>

                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts_custom')

@endpush

