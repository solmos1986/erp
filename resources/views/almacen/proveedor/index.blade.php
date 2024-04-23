@extends('layouts.admin')
@push('css')
    <!-- third party css -->
    <link href="{{ asset('/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">ERP</a></li>
                        <li class="breadcrumb-item"><a href="#">Alamacen</a></li>
                        <li class="breadcrumb-item active">Proveedores</li>
                    </ol>
                </div>
                <h4 class="page-title">Proveedores</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">

        </div>
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">

        </div>
        <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12">
            <div class="text-lg-end">
                <a href="#"><button type="button" id="serchbtn"
                        class="nuevo btn btn-success waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i>
                        Nuevo Proveedor </button></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="dtProveedor" class="dtProveedor table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Proveedor</th>
                                <th>Telefono</th>
                                <th>Direccion</th>
                                <th>Correo Electronico</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>

    <x-components.modal size="modal-lg" id="modal_proveedor" nameBtnSave="Guardar" nameBtnClose="Cancelar"
        idBtnSave="btn_save">
        @include('almacen.proveedor.components.form-proveedor')
    </x-components.modal>
@endsection

@push('javascript')
    <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/js/proveedor/modal.js') }}"></script>
@endpush
