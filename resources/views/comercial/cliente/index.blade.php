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
        .imagen-container {
            top: 0%;
            left: 0%;
            height: 400px;
            width: 100%;
            overflow: hidden;
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
                        <li class="breadcrumb-item"><a href="#">Comercial</a></li>
                        <li class="breadcrumb-item active">Clientes</li>
                    </ol>
                </div>
                <h4 class="page-title">Clientes</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
        </div>
        <div class="col-lg-5">
        </div>
        <div class="col-lg-4">
            <div class="text-lg-end">
                <button type="button" class="nuevo btn btn-success waves-effect waves-light mb-2 me-2"><i
                    class="mdi mdi-plus-circle me-1"></i> Agregar Cliente</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="data-table-cliente table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Cliente</th>
                                <th>Telefono</th>
                                <th>Direccion</th>
                                <th>NIT / CI</th>
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
    <x-components.modal size="modal-xl" id="modal_cliente" nameBtnSave="Guardar" nameBtnClose="Cancelar"
        idBtnSave="btn_save">
        @include('commom.ModalCrear_Cliente')
    </x-components.modal>
@endsection

@push('javascript')
    <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/webcam-easy/webcam-easy.min.js') }}"></script>
    <script src="{{ asset('/js/components/datatables.js') }}"></script>
    <script src="{{ asset('/js/cliente/modal.js') }}"></script>
    <script src="{{ asset('/js/cliente/foto.js') }}"></script>
@endpush
