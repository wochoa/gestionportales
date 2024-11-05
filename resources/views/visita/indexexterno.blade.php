<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gobierno Regional Huanuco</title>
    <link rel="icon" type="image/png" href="{{ asset('app-assets/images/favicon-32x32.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
    <style>
        /* Tamaño del scroll */
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
            <div class="nav-scroller bg-white shadow-sm" style="background-color:rgba(29, 177, 120, 0.47) !important; height:2rem;">
                <div class="container nav-underline" style="text-align: center">
                    <b style="font-size: 18px;">REGISTRO DE VISITAS AL {{ $data->nom_direcciones_web }}</b>
                </div>
            </div>
        </div>
        <br>
        {{--    <div class="container-fluid" style="min-height: 600px;">--}}
        <div class="container-fluid" style="min-height: 350px; margin-bottom: 52px;">
            <div class="card card-info mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <p class="text-md text-justify"> Cualquier ciudadano o ciudadana puede ver el Registro de Visitas al
                                    {{ $data->nom_direcciones_web }}. En este registro, podras ver  los nombres de las personas que entran y las fechas de sus visitas. </p>
                                <a href="https://gestionportales.regionhuanuco.gob.pe/indexVisitasExterno/{{ $data->iddirecciones_web }}" class="btn btn-success btn-lg" target="_blank">Ver registro de visitas</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer" style="margin-left:0px !important; background-color: #1DB178 !important;">
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
    </div>
</body>
</html>
