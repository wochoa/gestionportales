@extends('plantillas.admin')
@section('titulopagina')
	Portalweb | publiación
@endsection
@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Publicación
      <small></small>
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">Publicación</li>
    </ol>
  </div>
@endsection

@section('contenido')
<div class="container-fluid">
@can('gp_publicacion_crear')
<div class="row p-2">
	<a href="newpublicaciones" class="btn btn-sm btn-primary">Crear publicación</a>
</div>
@endcan
	

<div class="row">
	
		<div class="col-sm-12">
			<div class="card card-primary card-outline">
				<div class="card-header">
		            <h3 class="card-title">Listado de publicaciones</h3>
		         </div> <!-- /.card-body -->
				<div class="card-body">
					<table class="table">
						<thead>
							<tr><th>ID</th><th>TITULO</th><th>FECHA PUBLICACION</th><th>Activo</th><th>ACCIONES</th></tr>
						</thead>
						<tbody>
							@foreach($datosnot as $not)
							<tr>
								<td>{{ $not->idnoticias }}</td><td>{!! html_entity_decode($not->titulo) !!}</td><td nowrap>{{ $not->fechapubli }}</td><td>
									<td>  
										@if($not->activo==1)
											<a href="/desactivapubli/{{ $not->idnoticias  }}"><i class="fa fa-toggle-on"></i></a>
											@else
											<a href="/activapubli/{{ $not->idnoticias  }}"><i class="fa fa-toggle-off"></i></a>
										@endif
									</td>
							
							</td><td nowrap>
								<a href="{{ $not->idnoticias }}/ver" title="ver prublicacion" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a> 
								@can('gp_publicacion_editar')<a href="{{ $not->idnoticias }}/editar" title="Editar prublicacion" class="btn btn-default btn-sm"><i class="fa fa-pen"></i></a>@endcan
								@can('gp_publicacion_eliminar')<a href="{{ $not->idnoticias }}/eliminar" title="Eliminar prublicacion" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>@endcan
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="card-footer clearfix">
	               {{ $datosnot->links() }}
	            </div>
			</div>
		</div>
		{{-- <div class="col-sm-3">
			<div class="card card-dark card-outline">
				<div class="card-body">
					sss
				</div>
			</div>
		</div> --}}
	
	
</div>


</div>
@endsection
@section('script')
<script type="text/javascript">
	$("ul.pagination").addClass('pagination-sm m-0 float-right');
</script>

<script>
	@if(Session::has('desactivanot'))
		toastr.error('{{ Session::get('desactivanot') }}')
	@endif

	@if(Session::has('activanot'))
		toastr.info('{{ Session::get('activanot') }}')
	@endif

	@if(Session::has('newpublicacion'))
		toastr.info('{{ Session::get('newpublicacion') }}')
	@endif

	@if(Session::has('elimnadoreg'))
		toastr.error('{{ Session::get('elimnadoreg') }}')
	@endif
	
	
</script>

@endsection

