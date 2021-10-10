@extends('plantillas.admin')
@section('titulopagina')
	Portalweb | Reporte de visitas
@endsection
@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Listado de reclamaciones
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">Resporte reclamaciones</li>
    </ol>
  </div>
@endsection

@section('contenido')
<div class="container-fluid">

    @livewire('reclamaciones')	


</div>
@endsection


