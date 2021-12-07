@extends('plantillas.admin')
@section('titulopagina')
	Portalweb | Reporte de visitas
@endsection
@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Reporte de visitas
      <small>(Enlace para compartir: <span>{{ $dnweb }}/visitas</span> )</small>
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">Resporte visita</li>
    </ol>
  </div>
@endsection

@section('contenido')
<div class="container-fluid">

	

@livewire('reporte-visitas')


</div>
@endsection
@section('script')
<script type="text/javascript">
	$("ul.pagination").addClass('pagination-sm m-0 float-right');

	@if(Session::has('eliminadopag'))
		toastr.error('{{ Session::get('eliminadopag') }}')
	@endif
</script>
@endsection

