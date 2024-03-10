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
                        <li class="breadcrumb-item"><a href="#">CONFIG DE DESARROLLADOR</a></li>
                        <li class="breadcrumb-item"><a href="#">Config. modulo</a></li>
                        <li class="breadcrumb-item breadcrumb-item active">Modulos</li>
                    </ol>
                </div>
                <h4 class="page-title">Modulos</h4>
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
                            {{--     <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ count($roles) }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Roles</p>
                            </div> --}}
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div>
        <div class="col-xl-4 col-md-4 col-ms-6">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-light">
                                <i class="fe-list font-26 avatar-title text-primary"></i>
                            </div>
                        </div>
                        {{-- <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ count($usuarios) }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Modulos</p>
                            </div>
                        </div> --}}
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div><!-- end col-->
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
            <!-- project card -->
            <div class="card d-block">
                <div class="card-body">
                    <!-- project title-->
                    <h4 class="mt-0 font-15">
                        Lista secciones
                    </h4>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary nuevo mb-2" type="button">
                            Nueva seccion
                        </button>
                    </div>
                    <table class="data-table-super-modulo table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
            <!-- project card -->
            <div class="card d-block">
                <div class="card-body">
                    <!-- project title-->
                    <h4 class="mt-0 font-15">
                        Modulos
                    </h4>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary nuevo_modulo mb-2" type="button">
                            Nueva modulo
                        </button>
                    </div>
                    <table class="data-table-modulo table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Url</th>
                                <th>Icon</th>
                                <th>Seccion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <!-- project card -->
            <div class="card d-block">
                <div class="card-body">
                    <!-- project title-->
                    <h4 class="mt-0 font-15">
                        Sub modulos
                    </h4>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary nuevo mb-2" type="button">
                            Nueva sub modulo
                        </button>
                    </div>
                    <table class="data-table-sub-modulo table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Url</th>
                                <th>Modulo</th>
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
    <x-components.modal size="modal-xl" id="modal_modulo" nameBtnSave="Guardar" nameBtnClose="Cancelar"
        idBtnSave="btn_save">
        @include('modulo.components.form-modulo')
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
    <script src="{{ asset('/js/modulos/super_modulo.js') }}"></script>
    <script src="{{ asset('/js/modulos/modulo.js') }}"></script>
    <script src="{{ asset('/js/modulos/sub_modulo.js') }}"></script>
@endpush
