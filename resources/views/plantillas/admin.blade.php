{{-- @php
$enlcae=request()->path();
$act_portal=substr($enlcae,0,9);//portalweb
$act_admin=substr($enlcae,0,13);//administrador
$act_sgd=substr($enlcae,0,3);//sgd
@endphp --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('titulopagina')</title>

  <link rel="icon" type="image/png" href="{{ asset('dist/img/favicon.png') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{ asset('plugins/dropzone/min/dropzone.min.css') }}">
    <!-- SweetAlert2 -->
    
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  {{-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --}}
  {{-- <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet"> --}}
  {{-- <style type="text/css">
    body{
       font-family: 'Oswald', sans-serif;
    }
    
  </style> --}}
@yield('css')
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <link rel="stylesheet" href="{{ asset('dist/css/stylo.css') }}">
  @livewireStyles


</head>
<body class="sidebar-mini layout-fixed  text-sm accent-lightblue {{ Auth::user()->darkmode }}">
  {{-- PONEMOS IMAGEN POR DEFECTO PARA EL AVATAR --}}
  @if(Auth::user()->avatar)
    @php
      //$avatar=Storage::url(Auth::user()->avatar)
      $ava=Auth::user()->avatar;
      $avatar='http://goredigital.regionhuanuco.gob.pe/storage/'.$ava;
    @endphp
  @else
    @php
      //$avatar=asset('dist/img/avatar.png');
      $avatar=Storage::url('avatar/logo.png')
    @endphp
  @endif
  {{-- FINALIZAMOS LA IMAGEN DE AVATAR --}}
  
<div class="wrapper">
  @php
  $navbar=Auth::user()->darkmode;//navbar-info
  if(Auth::user()->darkmode)
  {
    $foondonavbar='navbar-dark';
  }
  else {
    $foondonavbar='navbar-dark navbar-gray';
  }
@endphp
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand border-bottom-0 {{ $foondonavbar }}">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      @guest
      <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
      </li>
      @if (Route::has('register'))
          <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
      @endif
  @else
      <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" v-pre>
               <i class="far fa-user"></i>
          </a>

          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ $avatar }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">{{-- asset(Storage::url(Auth::user()->avatar))  --}}
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  {{ Auth::user()->adm_name }} {{ Auth::user()->adm_lastname }}
                  <span class="float-right text-sm text-success"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Usuarios:{{ Auth::user()->adm_email }}</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>Email:  {{ Auth::user()->adm_correo }}</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>Celular:  {{ Auth::user()->adm_telefono }}</p>
                
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{-- {{ __('Logout') }} --}}Cerrar Sesión
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
          </div>
      </li>
  @endguest
      <li>
        @livewire('fondo')
      </li>
 
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Administración</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ $avatar }}" class="img-circle elevation-2" alt="User Image">{{-- asset(Storage::url(Auth::user()->avatar)) --}}
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->adm_name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      {{-- @include('plantillas.supermenu') --}}
      {{-- @include('plantillas.administrador') --}}
      {{-- @include('plantillas.publicador') --}}
      {{-- @include('plantillas.atencionciudadno') --}}
      {{-- @include('plantillas.pide') --}}
      {{-- @include('plantillas.visitas') --}}
      <!-- /.sidebar-menu -->
      {{-- @php
          $intro=acceso(auth()->user()->rol);
      @endphp
      @include($intro) --}}
      @include('plantillas.supermenu')
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          {{-- <div class="col-sm-6">
            <h1>
              Modals & Alerts 
              <small>new</small>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Modals & Alerts</li>
            </ol>
          </div> --}}
          @yield("titulosuperior")
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      
        @yield("contenido")
        <!-- ./row -->
      

     {{-- aqui se colocan normalmente los modales --}}
     @yield('modales')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="#">GOREHCO</a>.</strong> Todo los derechos reservados
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@livewireScripts
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>

@yield('script')
</body>
</html>
