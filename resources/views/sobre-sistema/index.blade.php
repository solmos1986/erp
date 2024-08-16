@extends('layouts.admin')
@push('css')
@endpush

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Config sistemas</a></li>
                        <li class="breadcrumb-item"><a href="#">Inf. sistema</a></li>
                        <li class="breadcrumb-item active">Sobre sistema</li>
                    </ol>
                </div>
                <h4 class="page-title">Sobre el sistema</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <!-- project card -->
            <div class="card d-block">
                <div class="card-body">
                    <!-- project title-->
                    <h1 class="mt-0 font-15">
                        Informacion
                    </h1>

                    {{ $informacion }}
                    <hr>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
@endpush
