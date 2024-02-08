@extends('layouts.dt')


@section('dtContent')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">ERP</a></li>
                        <li class="breadcrumb-item"><a href="#">Almacen</a></li>
                        <li class="breadcrumb-item active">Proveedores</li>
                    </ol>
                </div>
                <h4 class="page-title">PROVEEDORES</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-md-3 mb-2">
            <div class="input-group">
                <input type="text" class="form-control" id="validationCustom15" placeholder="Buscar producto" required>
            </div>
        </div>
        <div class="col-md-6 mb-2">
        </div>
        <div class="col-md-3 col-md-push mb-2">

            <div class="input-group">

                <button type="button" id="serchbtn" class="btn rounded-pill btn-success nuevo">NUEVO</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="dtUsuario" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Cliente</th>
                                <th>Direccion</th>
                                <th>Telefono</th>
                                <th>e-Mail</th>
                                <th>Identificacion</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>

                </div> <!-- end card body-->
                {{--  <div>
                    {{ $categorias->render() }}
                </div> --}}
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>



    <script type="text/javascript">
        $(function() {
            var table = $('dtUsuario').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('index.usuario') }}",
                columns: [{
                        data: 'idUsuario',
                        name: 'idUsuario'
                    },
                    {
                        data: 'nomUsuario',
                        name: 'nomUsuario'
                    },
                    {
                        data: 'docUsuario',
                        name: 'docUsuario'
                    },
                    {
                        data: 'telUsuario',
                        name: 'telUsuario'
                    },
                    {
                        data: 'dirUsuario',
                        name: 'dirUsuario'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
