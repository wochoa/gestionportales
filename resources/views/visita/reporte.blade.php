@extends('plantillas.admin')

@section('titulopagina')
    Portalweb | Reporte de visitas
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <style>
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

        .head-modal {
            background-color: #1367C8 !important;
            border: 1px #1367C8 solid !important;
            color: #fff !important;
        }
    </style>
@endsection

@section('titulosuperior')
    <div class="col-sm-6">
        <h1>
            Reporte de visitas
            <small></small>
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Main</a></li>
            <li class="breadcrumb-item active">Reporte de visitas</li>
        </ol>
    </div>
@endsection

@section('contenido')
    <div class="container-fluid">
        <div class="card card-info mb-3">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-table"></i> LISTA DE VISITAS</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <input type="hidden" id="oficodigo" name="oficodigo" value="{{ auth()->user()->depe_id}}">
                            <input type="hidden" id="iddireccionesweb" name="iddireccionesweb" value="{{ \App\Helpers\Helper::verificarAcceso() }}">
                            <input type="text" class="form-control form-control-sm" id="txtbusqueda" name="txtbusqueda" placeholder="Ingrese aqui el nombre, entidad o cargo de la persona...">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="form-group">
                            <input type="hidden" id="fechabusqueda" name="fechabusqueda">
                            <div class="input-group">
                                <button type="button" class="btn btn-default float-right" id="daterange-btn">
                                    <span> <i class="fa fa-calendar-alt"></i> Rango de fechas</span>
                                    <i class="fas fa-caret-down"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="form-group">
                            <button type="button" class="btn btn-info btn-xs float-left" id="btnbuscar">
                                <i class="fa fa-search-plus"></i>
                                Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table id="tblvisita" class="table display table-bordered table-striped">
                            <thead class="thead-dark">
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
@endsection
@section('script')
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

    <script src="{{ asset('app-assets/js/visita.js') }}"></script>

    <script type="text/javascript">
        $(function () {
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
                    url: '/listarVisitasReporte',
                    type: 'POST',
                    data: {
                        "portal" : $("#iddireccionesweb").val(),
                        "busqueda" : $("#txtbusqueda").val(),
                        "fecha": $('#fechabusqueda').val(),
                        "oficodigo": $('#oficodigo').val(),
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
                            mensaje("El rango de fechas no debe exceder los 90 días.");
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
                tblvisita.ajax.url('/listarVisitas'); // Establecer la URL de la solicitud AJAX
                const data = {
                    "portal": $("#iddireccionesweb").val(),
                    "busqueda": $("#txtbusqueda").val(),
                    "fecha": $('#fechabusqueda').val(),
                    "oficodigo": $('#oficodigo').val(),
                    "_token": token
                };

                tblvisita.settings()[0].ajax.data = function (d) {
                    return $.extend({}, d, data);
                };

                tblvisita.ajax.reload();
            });
        });

        // @if(Session::has('success'))
        //    toastr.success('{{ Session::get('success') }}')
        // @endif

        // window.livewire.on('regvisita', () => {
        //$('#atender').modal('hide');
        // toastr.success('Fue registrado la visita')
        //
        // });
        //
        // window.livewire.on('dninoexiste', () => {
        //     //$('#atender').modal('hide');
        //     toastr.error('El dni digitado no Ingresó')
        //
        // });
        //
        // window.livewire.on('dnisalida', () => {
        //     //$('#atender').modal('hide');
        //     toastr.info('Fue registrado la salida')
        //
        // });
    </script>

@endsection
