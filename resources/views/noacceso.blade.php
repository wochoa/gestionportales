@extends('plantillas.admin')
@section('titulopagina')
	Admin|Acceso
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Acceso
      <small></small>
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Administrador</a></li>
      <li class="breadcrumb-item active">No tienes acceso</li>
    </ol>
  </div>
@endsection
@section('contenido')

<!-- Main content -->
<section class="content">
    <div class="error-page">
      <h2 class="headline text-warning"> 404</h2>

      <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! No tienes acceso a esta plataforma</h3>

        <p>
         Tienes comunicarte con el administrador o informatico de tu dependencia.
         
        </p>

        <form class="search-form">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar...">

            <div class="input-group-append">
              <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
              </button>
            </div>
          </div>
          <!-- /.input-group -->
        </form>
      </div>
      <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
  </section>
  <!-- /.content -->
	
@endsection