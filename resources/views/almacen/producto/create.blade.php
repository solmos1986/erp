@extends('layouts.admin')
@push('css')
    <!-- third party css -->
    <link href="{{ asset('/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('contenido')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Almacen</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Productos</a></li>
                        <li class="breadcrumb-item active">Agregar Producto</li>
                    </ol>
                </div>
                <h4 class="page-title">Agregar Producto</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @include('almacen.producto.components.form-producto-create')
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="text-center mb-3">
                <a href="{{ url('almacen/producto') }}"><button type="button"
                        class="btn w-sm btn-light waves-effect">Cancelar</button></a>
                <button type="button" class="btn w-sm btn-primary waves-effect waves-light store">Guardar</button>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/libs/quill/quill.min.js') }}"></script>
    <script src="{{ asset('/libs/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('/js/producto/create.js') }}"></script>
@endpush
