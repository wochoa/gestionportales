<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gobierno Regional Hu�nuco</title>
    <link rel="icon" type="image/png" href="{{ asset('app-assets/images/favicon-32x32.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
    <style>
        /* Tama�o del scroll */
        body::-webkit-scrollbar {
            width: 8px;
        }

        /* Estilos barra (thumb) de scroll */
        body::-webkit-scrollbar-thumb {
            background: #0dcaf0;
            border-radius: 4px;
        }

        body::-webkit-scrollbar-thumb:active {
            background-color: #999999;
        }

        body::-webkit-scrollbar-thumb:hover {
            background: #404148;
            box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);
        }

        /* Estilos track de scroll */
        body::-webkit-scrollbar-track {
            /* background: #e1e1e1; */
            border-radius: 4px;
        }

        body::-webkit-scrollbar-track:hover,
        body::-webkit-scrollbar-track:active {
            background: #d4d4d4;
        }

        html,body {
            overflow-x: hidden; /* Prevent scroll on narrow devices */
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            color: rgba(255, 255, 255, .75);
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .nav-underline .nav-link {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: .875rem;
            color: #6c757d;
        }

        .nav-underline .nav-link:hover {
            /* background: #ffffff; */
            opacity: 50%;
            color: #000000;
            font-weight: bold;
        }

        .nav-underline .active {
            font-weight: 500;
            color: #ffffff;
            text-align: center;
        }

        .arriba1 {
            float: right;
            margin-left: 0px;
            margin-bottom: 5px;
            /* position: inherit; */
            display: block;
            margin-right: 5px;
        }

        .btn-group{
            display: block !important;
        }

        .footer {
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="layout-top-nav layout-navbar-fixed text-sm">
    <div class="wrapper">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm" style="background-color: #1DB178 !important;">
            <div class="container">
                <a href="#">
                    <img src="{{ asset('app-assets/images/logo-rv.png') }}" height="60">
                </a>
            </div>
        </nav>
        <div class="nav-scroller bg-white shadow-sm" style="background-color:rgba(29, 177, 120, 0.47) !important; height:3.75rem;">
            <div class="container nav-underline" style="text-align: center">
                <b style="font-size: 20px;">Sistema de Registro de Visitas en Linea</b> <br>{{ $data->nom_direcciones_web }}
            </div>
        </div>
    </div>
    <br>
{{--    <div class="container-fluid" style="min-height: 600px;">--}}
    <div class="container-fluid" style="min-height: calc(100% - 70px); margin-bottom: 52px;">
        <div class="card card-info mb-3">
{{--            <div class="card-header">--}}
{{--                <h3 class="card-title"><i class="fa fa-table"></i> LISTA DE VISITAS</h3>--}}
{{--            </div>--}}
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <input type="hidden" id="iddireccionesweb" name="iddireccionesweb" value="{{ $data->iddirecciones_web }}">
                            <input type="text" class="form-control form-control-sm" id="txtbusqueda" name="txtbusqueda" placeholder="Ingrese aqui el nombre, entidad o cargo de la persona...">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <input type="hidden" id="fechabusqueda" name="fechabusqueda">
                            <div class="input-group">
                                <button type="button" class="btn btn-default float-right" id="daterange-btn">
                                    <span> <i class="fa fa-calendar-alt"></i> Rango de fechas</span>
                                    <i class="fas fa-caret-down"></i>
                                </button>&nbsp;&nbsp;&nbsp;
								<button type="button" class="btn btn-info btn-xs float-left ml-2" id="btnbuscar">
									<i class="fa fa-search-plus"></i>
									Buscar
								</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table id="tblvisita" class="table display table-bordered table-striped table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>Nro.</th>
                                <th>Fecha de visita</th>
                                <th>Visitante</th>
                                <th>Documento del visitante</th>
                                <th>Entidad del visitante</th>
                                <th>Funcionario visitado</th>
                                <th>Hora ingreso</th>
                                <th>Hora salida</th>
                                <th>Motivo</th>
                                <th>Lugar especifico</th>
                                <th>Observaciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="main-footer footer" style="margin-left:0px !important; background-color: #1DB178 !important;">
        <div class="container">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                <a href="{{ $data->linkdirecciones_web }}" style="color: #FFF212">
                    <b>{{ $data->nom_direcciones_web }}</b>
                </a>
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2023</strong> Todos los derechos reservados.
        </div>
    </footer>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script>
        $(function () {
            //Date range picker
            $('#daterange-btn').daterangepicker({
                locale: {
                    "applyLabel": "Aceptar",
                    "cancelLabel": "Cancelar",
                    "fromLabel": "Desde",
                    "toLabel": "Hasta",
                    "customRangeLabel": "Seleccione periodo",
                    "daysOfWeek": [
                        "Do",
                        "Lu",
                        "Ma",
                        "Mi",
                        "Ju",
                        "Vi",
                        "Sa"
                    ],
                    "monthNames": [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "August",
                        "Setiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ]
                },
                ranges   : {
                    'Hoy'       : [moment(), moment()],
                    'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Últimos 7 Días' : [moment().subtract(6, 'days'), moment()],
                    'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],
                    'Mes Actual'  : [moment().startOf('month'), moment().endOf('month')],
                    'Mes Anterior'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                maxSpan: {
                    "days": 89
                },
                startDate: moment(),//.subtract(29, 'days'),
                endDate  : moment()
            }, cb);

            function cb(start, end) {
                $('#daterange-btn span').html('<i class="fa fa-calendar-alt"></i>&nbsp;&nbsp;&nbsp;' + start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
                $('#fechabusqueda').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
                startDate = start;
                endDate = end;
            }

            cb(moment(), moment());

            const token = $('meta[name="csrf-token"]').attr('content');
            const tblvisita = $('#tblvisita').DataTable({
                "language": {
                    "url": "/plugins/datatables/dtspanish.json"
                },
                processing: true,
                serverSide: true,
                // serverMethod: 'get',
                search: {
                    return: true
                },
                responsive: false,
                ajax: {
                    url: '/listarVisitasExterno',
                    type: 'POST',
                    data: {
                        "portal" : $("#iddireccionesweb").val(),
                        "busqueda" : $("#txtbusqueda").val(),
                        "fecha": $('#fechabusqueda').val(),
                        "_token": token
                    },
                    error: function(jqXHR, exception) {
                    },
                    statusCode: {
                        200: function() {
                            console.log('OK 200')
                        },
                        404: function() {
                            console.log('Bad Request 400');
                            tblvisita.clear().draw();
                            mensaje("El rango de fechas no debe exceder los 90 d�as.");
                        }
                    }
                },
                autoWidth: false,
                columns: [
                    {
                        data: 'idregvisita',
                        name: 'idregvisita',
                        className: 'dt-center dt-head-center',
                    },
                    {
                        data: 'fechavisita',
                        name: 'fechavisita',
                        className: 'dt-center dt-head-center',
                    },
                    {
                        data: 'nombre',
                        name: 'nombre',
                        className: 'dt-justify dt-head-center',
                    },
                    {
                        data: 'dni',
                        name: 'dni',
                        className: 'dt-center dt-head-center',
                    },
                    {
                        data: 'institucion',
                        name: 'institucion',
                        className: 'dt-justify dt-head-center',
                    },
                    {
                        data: 'funcionario',
                        name: 'funcionario',
                        className: 'dt-justify dt-head-center',
                    },
                    {
                        data: 'horaingreso',
                        name: 'horaingreso',
                        className: 'dt-center dt-head-center',
                    },
                    {
                        data: 'horasalida',
                        name: 'horasalida',
                        className: 'dt-center dt-head-center',
                    },
                    {
                        data: 'motivo',
                        name: 'motivo',
                        className: 'dt-justify dt-head-center',
                    },
                    {
                        data: 'lugar',
                        name: 'lugar',
                        className: 'dt-justify dt-head-center',
                    },
                    {
                        data: 'observaciones',
                        name: 'observaciones',
                        className: 'dt-justify dt-head-center',
                    }
                ],
                order: [[0, 'desc']],
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
                // dom: 'Blrtip',
                dom: '<"row col-lg-12 col-md-12 col-sm-12 arriba1"B><"arriba2"lr><"abajo"tip><"clear">',
                text: 'Export',
                buttons: [
                    { extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i>&nbsp;Excel',
                        "className": 'btn btn-success btn-sm float-right'},
                ],
            });

            $('#btnbuscar').click(function(){
                tblvisita.ajax.url('/listarVisitasExterno'); // Establecer la URL de la solicitud AJAX
                const data = {
                    "portal": $("#iddireccionesweb").val(),
                    "busqueda": $("#txtbusqueda").val(),
                    "fecha": $('#fechabusqueda').val(),
                    "_token": token
                };

                tblvisita.settings()[0].ajax.data = function (d) {
                    return $.extend({}, d, data);
                };

                tblvisita.ajax.reload();
            });
        });
    </script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
