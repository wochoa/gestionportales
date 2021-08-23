@extends('plantillas.admin')

@section('titulopagina')
	Portalweb | anuncios emergentes
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Registro de anuncios emergentes
      <small></small>
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">anuncio emergente</li>
    </ol>
  </div>
@endsection

@section('contenido')
{{-- <div class="row p-2">
	<a href="newpublicaciones" class="btn btn-sm btn-primary">Crear publicación</a>
</div> --}}

@livewire('visitas')


@endsection
