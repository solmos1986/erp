@extends('layouts.admin')
@push('css')
@endpush

@section('contenido')
    <div class="row">
        <div class="col-md-6 col-xl-6 mt-2 mb-2">
            <h3 class="page-title">Dashboard</h3>

        </div>

        <div class="col-md-6 col-xl-6 mt-3 mb-2">

            {{-- <div class="widget-rounded-circle card">
                <div class="card-body"> --}}
            <div class="row">
                <div class="col-6">
                    <div class="input-group input-group-sm">
                        <select class="filtrar form-select" id="idUsuario">
                            <option value="">Filtrar Usuario</option>
                            @foreach ($usuario as $user)
                                <option value="{{ $user->idUsuario }}">{{ $user->nomUsuario }}
                                </option>
                            @endforeach
                        </select>
                        <span class="input-group-text bg-blue border-blue text-white">
                            <i class="mdi mdi-account-search-outline"></i>
                        </span>
                    </div>

                </div>

                <div class="col-6">
                    <div class="input-group input-group-sm">
                        <input type="text" class="filtrar form-control border" id="rango_fecha">
                        <span class="input-group-text bg-blue border-blue text-white">
                            <i class="mdi mdi-calendar-range"></i>
                        </span>
                    </div>

                </div>
            </div>
            {{-- </div>
            </div> --}} <!-- end widget-rounded-circle-->

        </div> <!-- end col-->
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                <i class="fe-heart font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup" id="TotalInscripciones"></span>
                                </h3>
                                <p class="text-muted mb-1 text-truncate">Total Inscripciones</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                <i class="fe-shopping-cart font-22 avatar-title text-success"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup" id="TotalVentas"></span></h3>
                                <p class="text-muted mb-1 text-truncate">Total Ventas</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup" id="TotalCompras"></span></h3>
                                <p class="text-muted mb-1 text-truncate">Total Compras</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                <i class="fe-eye font-22 avatar-title text-warning"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup" id="TotalImpuestos"></span></h3>
                                <p class="text-muted mb-1 text-truncate">Impuestos</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>

                    <h4 class="header-title mb-0">Total Revenue</h4>

                    <div class="widget-chart text-center" dir="ltr">

                        <div id="total-revenue" class="mt-0" data-colors="#f1556c"></div>

                        <h5 class="text-muted mt-0">Total sales made today</h5>
                        <h2>$178</h2>

                        <p class="text-muted w-75 mx-auto sp-line-2">Traditional heading elements are designed to work best
                            in the meat of your page content.</p>

                        <div class="row mt-3">
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                <h4><i class="fe-arrow-down text-danger me-1"></i>$7.8k</h4>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                <h4><i class="fe-arrow-up text-success me-1"></i>$1.4k</h4>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                                <h4><i class="fe-arrow-down text-danger me-1"></i>$15k</h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col-->

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body pb-2">
                    <div class="float-end d-none d-md-inline-block">
                        <div class="btn-group mb-2">
                            <button type="button" class="semana btn btn-xs btn-light">Semana</button>
                            <button type="button" class="mes btn btn-xs btn-light">Mes</button>
                            <button type="button" class="anio btn btn-xs btn-secondary">Año</button>
                        </div>
                    </div>

                    <h4 class="header-title mb-3">Sales Analytics</h4>

                    <div dir="ltr">
                        <div id="chart" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col-->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>

                    <h4 class="header-title mb-3">Top 5 Users Balances</h4>

                    <div class="table-responsive">
                        <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                            <thead class="table-light">
                                <tr>
                                    <th colspan="2">Profile</th>
                                    <th>Currency</th>
                                    <th>Balance</th>
                                    <th>Reserved in orders</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 36px;">
                                        <img src="assets/images/users/user-2.jpg" alt="contact-img" title="contact-img"
                                            class="rounded-circle avatar-sm" />
                                    </td>

                                    <td>
                                        <h5 class="m-0 fw-normal">Tomaslau</h5>
                                        <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                    </td>

                                    <td>
                                        <i class="mdi mdi-currency-btc text-primary"></i> BTC
                                    </td>

                                    <td>
                                        0.00816117 BTC
                                    </td>

                                    <td>
                                        0.00097036 BTC
                                    </td>

                                    <td>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i
                                                class="mdi mdi-plus"></i></a>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i
                                                class="mdi mdi-minus"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 36px;">
                                        <img src="assets/images/users/user-3.jpg" alt="contact-img" title="contact-img"
                                            class="rounded-circle avatar-sm" />
                                    </td>

                                    <td>
                                        <h5 class="m-0 fw-normal">Erwin E. Brown</h5>
                                        <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                    </td>

                                    <td>
                                        <i class="mdi mdi-currency-eth text-primary"></i> ETH
                                    </td>

                                    <td>
                                        3.16117008 ETH
                                    </td>

                                    <td>
                                        1.70360009 ETH
                                    </td>

                                    <td>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i
                                                class="mdi mdi-plus"></i></a>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i
                                                class="mdi mdi-minus"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 36px;">
                                        <img src="assets/images/users/user-4.jpg" alt="contact-img" title="contact-img"
                                            class="rounded-circle avatar-sm" />
                                    </td>

                                    <td>
                                        <h5 class="m-0 fw-normal">Margeret V. Ligon</h5>
                                        <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                    </td>

                                    <td>
                                        <i class="mdi mdi-currency-eur text-primary"></i> EUR
                                    </td>

                                    <td>
                                        25.08 EUR
                                    </td>

                                    <td>
                                        12.58 EUR
                                    </td>

                                    <td>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i
                                                class="mdi mdi-plus"></i></a>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i
                                                class="mdi mdi-minus"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 36px;">
                                        <img src="assets/images/users/user-5.jpg" alt="contact-img" title="contact-img"
                                            class="rounded-circle avatar-sm" />
                                    </td>

                                    <td>
                                        <h5 class="m-0 fw-normal">Jose D. Delacruz</h5>
                                        <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                    </td>

                                    <td>
                                        <i class="mdi mdi-currency-cny text-primary"></i> CNY
                                    </td>

                                    <td>
                                        82.00 CNY
                                    </td>

                                    <td>
                                        30.83 CNY
                                    </td>

                                    <td>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i
                                                class="mdi mdi-plus"></i></a>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i
                                                class="mdi mdi-minus"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 36px;">
                                        <img src="assets/images/users/user-6.jpg" alt="contact-img" title="contact-img"
                                            class="rounded-circle avatar-sm" />
                                    </td>

                                    <td>
                                        <h5 class="m-0 fw-normal">Luke J. Sain</h5>
                                        <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                    </td>

                                    <td>
                                        <i class="mdi mdi-currency-btc text-primary"></i> BTC
                                    </td>

                                    <td>
                                        2.00816117 BTC
                                    </td>

                                    <td>
                                        1.00097036 BTC
                                    </td>

                                    <td>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i
                                                class="mdi mdi-plus"></i></a>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i
                                                class="mdi mdi-minus"></i></a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>

                    <h4 class="header-title mb-3">Revenue History</h4>

                    <div class="table-responsive">
                        <table class="table table-borderless table-nowrap table-hover table-centered m-0">

                            <thead class="table-light">
                                <tr>
                                    <th>Marketplaces</th>
                                    <th>Date</th>
                                    <th>Payouts</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 class="m-0 fw-normal">Themes Market</h5>
                                    </td>

                                    <td>
                                        Oct 15, 2018
                                    </td>

                                    <td>
                                        $5848.68
                                    </td>

                                    <td>
                                        <span class="badge bg-soft-warning text-warning">Upcoming</span>
                                    </td>

                                    <td>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i
                                                class="mdi mdi-pencil"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h5 class="m-0 fw-normal">Freelance</h5>
                                    </td>

                                    <td>
                                        Oct 12, 2018
                                    </td>

                                    <td>
                                        $1247.25
                                    </td>

                                    <td>
                                        <span class="badge bg-soft-success text-success">Paid</span>
                                    </td>

                                    <td>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i
                                                class="mdi mdi-pencil"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h5 class="m-0 fw-normal">Share Holding</h5>
                                    </td>

                                    <td>
                                        Oct 10, 2018
                                    </td>

                                    <td>
                                        $815.89
                                    </td>

                                    <td>
                                        <span class="badge bg-soft-success text-success">Paid</span>
                                    </td>

                                    <td>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i
                                                class="mdi mdi-pencil"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h5 class="m-0 fw-normal">Envato's Affiliates</h5>
                                    </td>

                                    <td>
                                        Oct 03, 2018
                                    </td>

                                    <td>
                                        $248.75
                                    </td>

                                    <td>
                                        <span class="badge bg-soft-danger text-danger">Overdue</span>
                                    </td>

                                    <td>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i
                                                class="mdi mdi-pencil"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h5 class="m-0 fw-normal">Marketing Revenue</h5>
                                    </td>

                                    <td>
                                        Sep 21, 2018
                                    </td>

                                    <td>
                                        $978.21
                                    </td>

                                    <td>
                                        <span class="badge bg-soft-warning text-warning">Upcoming</span>
                                    </td>

                                    <td>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i
                                                class="mdi mdi-pencil"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h5 class="m-0 fw-normal">Advertise Revenue</h5>
                                    </td>

                                    <td>
                                        Sep 15, 2018
                                    </td>

                                    <td>
                                        $358.10
                                    </td>

                                    <td>
                                        <span class="badge bg-soft-success text-success">Paid</span>
                                    </td>

                                    <td>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i
                                                class="mdi mdi-pencil"></i></a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div> <!-- end .table-responsive-->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@push('javascript')
    <script src="{{ asset('/js/pages/dashboard-1.init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
    <script>
        var ventas = [];
        var compras = [];
        var inscripciones = [];

        $("#rango_fecha").flatpickr({
            mode: "range",
            dateFormat: "Y-m-d",
            defaultDate: [moment().startOf('month').format('YYYY-MM-DD'), moment().format('YYYY-MM-DD'), ]
        });
        let fecha = $("#rango_fecha").val();


        $(document).ready(function() {
            ConsultaDB();


        });

        function ConsultaDB() {
            let date = $("#rango_fecha").val();
            let idx = date.length / 2;
            let startDate = date.substr(0, idx - 2);
            let endDate = date.substr(idx + 2);
            $.ajax({
                type: "post",
                url: `${base_url}/dashboard`,
                dataType: 'json',
                data: {
                    startDate: startDate + 'T00:00:00',
                    endDate: endDate + 'T23:59:59',
                    idCliente: null,
                    idTipoPago: null,
                    idTipoComprobante: null,
                    idUsuario: $("#idUsuario").val(),
                },
                success: function(response) {
                    ventas = response.data;
                    compras = response.data2;
                    inscripciones = response.data3;
                    SumaVentas();
                    SumCompras();
                    SumImpuestos();
                    SumInscripciones();
                    graficarMes();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('error de programacion');
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'ejemplosdsfs!',
                    });
                },
                fail: function() {
                    console.log('error servidor')
                }
            })
        }

        function SumaVentas() {
            const totalesV = ventas.map((itemV) => {
                return itemV.total
            });
            const initialValueV = 0;
            const sumTotalV = totalesV.reduce(
                (accumulatorV, currentValueV) => accumulatorV + currentValueV,
                initialValueV,
            );
            $("#TotalVentas").text('Bs. ' + sumTotalV);
        }

        function SumCompras() {
            const totalesC = compras.map((item) => {
                return item.total

            });
            const initialValue = 0;
            const sumTotal = totalesC.reduce(
                (accumulator, currentValue) => accumulator + currentValue,
                initialValue,
            );
            $("#TotalCompras").text('Bs. ' + sumTotal);
        }

        function SumImpuestos() {
            const totalesImp = ventas.map((item) => {
                return item.impuestoIngreso

            });
            const initialValue = 0;
            const sumTotal = totalesImp.reduce(
                (accumulator, currentValue) => accumulator + currentValue,
                initialValue,
            );
            $("#TotalImpuestos").text('Bs. ' + sumTotal);
        }

        function SumInscripciones() {
            const totalesIns = inscripciones.map((item) => {
                return item.costoPaquete

            });
            const initialValue = 0;
            const sumTotal = totalesIns.reduce(
                (accumulator, currentValue) => accumulator + currentValue,
                initialValue,
            );
            $("#TotalInscripciones").text('Bs. ' + sumTotal);
        }
        $(document).on('keyup change', '.filtrar', function() {
            ConsultaDB();
        })

        function graficarMes() {
            var today = new Date();
            var end = new Date();
            var start = new Date(end.setMonth(end.getMonth() - 1));
            var daysOfMonth = [];
            for (var d = new Date(start); d <= today; d.setDate(d.getDate() + 1)) {
                daysOfMonth.push(moment(d).format("YYYY-MM-DD"));
            }
            graficar(start, today, daysOfMonth);
        }

        $(document).on('click', '.semana', function() {
            var todayW = new Date();
            var endW = new Date();
            var startW = new Date(endW.setDate(endW.getDate() - 7));
            var daysOfWeek = [];
            for (var dW = new Date(startW); dW <= todayW; dW.setDate(dW.getDate() + 1)) {
                daysOfWeek.push(moment(dW).format("YYYY-MM-DD"));
            }
            graficar(startW, todayW, daysOfWeek);
        })

        $(document).on('click', '.mes', function() {
            var today = new Date();
            var end = new Date();
            var start = new Date(end.setMonth(end.getMonth() - 1));
            var daysOfMonth = [];
            for (var d = new Date(start); d <= today; d.setDate(d.getDate() + 1)) {
                daysOfMonth.push(moment(d).format("YYYY-MM-DD"));
            }
            graficar(start, today, daysOfMonth);
        })

        $(document).on('click', '.anio', function() {
            var todayY = new Date();
            var endY = new Date();
            var startY = new Date(endY.setMonth(endY.getMonth() - 12));
            var monthsOfYear = [];
            for (var dY = new Date(startY); dY <= todayY; dY.setMonth(dY.getMonth() + 1)) {
                monthsOfYear.push(dY.getFullYear() + "-" + (dY.getMonth() + 1));
            }
            graficar(startY, todayY, monthsOfYear);
        })

        function graficar(startDate, endDate, rango) {
            $.ajax({
                type: "post",
                url: `${base_url}/dashboard/totales`,
                dataType: 'json',
                data: {
                    startDate: moment(startDate).format("YYYY-MM-DD") + 'T00:00:00',
                    endDate: moment(endDate).format("YYYY-MM-DD") + 'T23:59:59',
                },
                success: function(response) {

                    ventas = response.data;
                    compras = response.data2;
                    inscripciones = response.data3;
                    mapeando(ventas, compras, inscripciones, rango);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('error de programacion');
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'ejemplosdsfs!',
                    });
                },
                fail: function() {
                    console.log('error servidor')
                }
            })

        }

        function mapeando(ventas, compras, inscripciones, rango) {
            var range = rango
            var DataVentas = [];
            var DataCompras = [];
            var DataInscripciones = [];

            range.forEach(element => {
                const validarV = ventas.find((venta) => venta.fechaIngreso == element)
                if (validarV != undefined) {
                    DataVentas.push(validarV.total)

                } else {
                    DataVentas.push(0)
                }
            })
            range.forEach(element => {
                const validarC = compras.find((compra) => compra.fechaEgreso == element)
                if (validarC != undefined) {
                    DataCompras.push(validarC.total)

                } else {
                    DataCompras.push(0)
                }
            })
            range.forEach(element => {
                const validarI = inscripciones.find((inscripcion) => inscripcion.fechaInscripcion ==
                    element)
                if (validarI != undefined) {
                    DataInscripciones.push(validarI.total)

                } else {
                    DataInscripciones.push(0)
                }
            })
            grafico(range, DataVentas, DataCompras, DataInscripciones);
        }

        function grafico(range, DataVentas, DataCompras, DataInscripciones) {
            var options = {
                series: [{
                        name: 'Ventas',
                        group: 'ingresos',
                        data: DataVentas
                    },
                    {
                        name: 'Inscripciones',
                        group: 'ingresos',
                        data: DataInscripciones
                    },
                    {
                        name: 'Compras',
                        group: 'pagos',
                        data: DataCompras
                    },
                    /* {
                        name: 'Q2 Actual',
                        group: 'actual',
                        data: [20000, 40000, 25000, 10000, 12000, 28000]
                    } */
                ],
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true,
                },
                stroke: {
                    width: 1,
                    colors: ['#fff']
                },
                dataLabels: {
                    formatter: (val) => {
                        return val / 1
                    },
                    style: {
                        fontSize: '8px',
                        /* fontWeight: 900 */
                    },
                    total: {
                        enabled: true,

                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                    }
                },
                xaxis: {
                    categories: range
                },
                fill: {
                    opacity: 1
                },
                colors: ['#80c7fd', '#008FFB', '#80f1cb', '#00E396'],
                yaxis: {
                    labels: {
                        formatter: (val) => {
                            return val / 1
                        }
                    }
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'left'
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }
    </script>
@endpush
