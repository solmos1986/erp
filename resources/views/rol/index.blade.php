@extends('layouts.admin')
@push('css')
    <!-- Bootstrap css -->
    <link href="{{ asset('/libs/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
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
                        <li class="breadcrumb-item"><a href="#">ACCESIBILIDAD</a></li>
                        <li class="breadcrumb-item"><a href="#">Roles y permisos</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </div>
                <h4 class="page-title">Roles</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-4 col-md-4 col-ms-6">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-light">
                                <i class="fe-list font-26 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ count($roles) }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Roles</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <!-- project card -->
            <div class="card d-block">
                <div class="card-body">
                    <!-- project title-->
                    <h4 class="mt-0 font-15">
                        Lista de roles
                    </h4>
                    <button class="btn btn-primary nuevo" type="button">
                        {{-- <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true" ></span> --}}
                        Nuevo rol
                    </button>
                    <hr>
                    <table class="data-table-roles table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Rol</th>
                                <th>Modulos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
    </div>

    <x-components.modal size="modal-xl" id="modal_rol" nameBtnSave="Guardar" nameBtnClose="Cancelar" idBtnSave="btn_save">
        @include('rol.components.form-rol')
    </x-components.modal>
@endsection

@push('javascript')
    <script src="{{ asset('/libs/bootstrap-table/bootstrap-table.min.js') }}"></script>
    <!-- Init js -->
    <script src="{{ asset('/js/pages/bootstrap-tables.init.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <!-- Select2 js-->
    <script src="{{ asset('/libs/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('/js/components/datatables.js') }}"></script>
    <script src="{{ asset('/js/roles/rol.js') }}"></script>
    <script src="{{ asset('/js/roles/checkList.js') }}"></script>
    <!-- Sockets-->
    <script src="{{ asset('/js/socket/dispositivo-socket.js') }}"></script>
@endpush
