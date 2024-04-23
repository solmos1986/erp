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
    <style>
        .app-search form .input-group-text {
            margin-left: 0;
            z-index: 4
        }

        .bootstrap-touchspin .btn .input-group-text {
            padding: 0;
            border: none;
            background-color: transparent;
            color: inherit
        }
    </style>
@endpush

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">ERP</a></li>
                        <li class="breadcrumb-item"><a href="#">Configuracion</a></li>
                        <li class="breadcrumb-item active">Control de Acceso</li>
                    </ol>
                </div>
                <h4 class="page-title">LECTORES</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row mb-2">
        <div class="col-xl-5 col-lg-5 col-md-3 col-sm-12">
        </div>
        <div class="col-xl-5 col-lg-5 col-md-3 col-sm-12">
        </div>
        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12">
            <div class="text-lg-end">
                <button type="button" id="serchbtn" class="nuevo btn btn-success waves-effect waves-light w-100"><i
                        class="mdi mdi-plus me-1"></i>
                    Nuevo Lector </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="dtLectores" class="dtLectores table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Direccion IP</th>
                                <th>Usuario</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    <x-components.modal size="modal-lg" id="ModalLector" nameBtnSave="Guardar" nameBtnClose="Cancelar" idBtnSave="btn_save">
        @include('configuracion.lectores.components.form-lector')
    </x-components.modal>
@endsection

@push('javascript')
    <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/js/lector/modal.js') }}"></script>
@endpush
