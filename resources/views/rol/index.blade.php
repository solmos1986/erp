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
                        <li class="breadcrumb-item"><a href="#">Roles</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Roles</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-6 col-md-6 col-ms-4">
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
        <div class="col-xl-8 col-lg-6">
            <!-- project card -->
            <div class="card d-block">
                <div class="card-body">
                    <!-- project title-->
                    <h3 class="mt-0 font-20">
                        App design and development
                    </h3>
                    <table id="dtEgresos" class="dtEgresos table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Fecha</th>
                                <th>Proveedor</th>
                                <th>Comprobante</th>
                                <th>Numero</th>
                                <th>Impuestos</th>
                                <th>Metodo Pago</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>

                </div> <!-- end card-body-->

            </div> <!-- end card-->

            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="dripicons-dots-3"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Latest</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Popular</a>
                        </div>
                    </div>

                    <h4 class="mt-0 mb-3">Comments (258)</h4>

                    <textarea class="form-control form-control-light mb-2" placeholder="Write message" id="example-textarea" rows="3"></textarea>
                    <div class="text-end">
                        <div class="btn-group mb-2">
                            <button type="button" class="btn btn-link btn-sm text-muted font-18"><i
                                    class="dripicons-paperclip"></i></button>
                        </div>
                        <div class="btn-group mb-2 ms-2">
                            <button type="button" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </div>

                    <div class="mt-2">
                        <div class="d-flex align-items-start">
                            <img class="me-2 avatar-sm rounded-circle" src="assets/images/users/user-3.jpg"
                                alt="Generic placeholder image">
                            <div class="w-100">
                                <h5 class="mt-0"><a href="contacts-profile.html" class="text-reset">Jeremy
                                        Tomlinson</a> <small class="text-muted">3 hours ago</small></h5>
                                Nice work, makes me think of The Money Pit.

                                <br />
                                <a href="javascript: void(0);" class="text-muted font-13 d-inline-block mt-2"><i
                                        class="mdi mdi-reply"></i> Reply</a>

                                <div class="d-flex align-items-start mt-3">
                                    <a class="pe-2" href="#">
                                        <img src="assets/images/users/user-4.jpg" class="avatar-sm rounded-circle"
                                            alt="Generic placeholder image">
                                    </a>
                                    <div class="w-100">
                                        <h5 class="mt-0"><a href="contacts-profile.html" class="text-reset">Kathleen
                                                Thomas</a> <small class="text-muted">1 hours ago</small></h5>
                                        i'm in the middle of a timelapse animation myself! (Very different though.) Awesome
                                        stuff.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mt-3">
                            <img class="me-2 avatar-sm rounded-circle" src="assets/images/users/user-2.jpg"
                                alt="Generic placeholder image">
                            <div class="w-100">
                                <h5 class="mt-0"><a href="contacts-profile.html" class="text-reset">Jonathan Tiner</a>
                                    <small class="text-muted">1 day ago</small>
                                </h5>
                                The parallax is a little odd but O.o that house build is awesome!!

                                <br />
                                <a href="javascript: void(0);" class="text-muted font-13 d-inline-block mt-2"><i
                                        class="mdi mdi-reply"></i> Reply</a>

                            </div>
                        </div>

                        <div class="d-flex align-items-start mt-3">
                            <a class="pe-2" href="#">
                                <img src="assets/images/users/user-1.jpg" class="rounded-circle"
                                    alt="Generic placeholder image" height="31">
                            </a>
                            <div class="w-100">
                                <input type="text" id="simpleinput"
                                    class="form-control form-control-sm form-control-light" placeholder="Add comment">
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-2">
                        <a href="javascript:void(0);" class="text-danger"><i
                                class="mdi mdi-spin mdi-loading me-1 font-16"></i> Load more </a>
                    </div>
                </div> <!-- end card-body-->
            </div>
            <!-- end card-->
        </div>
    </div>
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
    <!-- Dropzone file uploads-->
    <script src="{{ asset('/libs/dropzone/min/dropzone.min.js') }}"></script>

    <!-- Quill js -->
    <script src="{{ asset('/libs/quill/quill.min.js') }}"></script>

    <!-- Init js-->
    <script src="{{ asset('/js/pages/form-fileuploads.init.js') }}"></script>

    <!-- Init js -->
    <script src="{{ asset('/js/pages/add-product.init.js') }}"></script>
    <script>

    </script>
    <!-- Bootstrap Tables js -->
@endpush
