@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <div class="alert alert-success mt-3">
                        <h1>Bienvenido</h1>
                        <h2><strong>{{ auth()->user()->nombre }}</strong></h2>
                        <h4>{{ auth()->user()->idusuarios }}</h4>
                        <h5>{{ auth()->user()->unidad }}</h5>
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

