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
@can('gp_pagina_crear')
<div class="row p-2">
	<a href="newpagina" class="btn btn-sm btn-primary">Crear página</a>
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
							<tr><th>ID</th><th>TITULO PAGINA</th><th>FECHA PUBLICACION</th><th>ACCIONES</th></tr>
						</thead>
						<tbody>
							{{-- @foreach($datospag as $not)
							
							@endforeach --}}
							@forelse($datospag as $not)
							<tr>
								<td nowrap>{{ $not->id_pagina }}</td><td>{!! $not->nom_pagina !!}</td><td nowrap>{{ $not->fecha_pag }}</td><td nowrap>
									<a href="verpagina/{{ $not->id_pagina }}" title="ver pagina" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a> 
									@can('gp_pagina_editar')<a href="editarpag/{{ $not->id_pagina }}" title="Editar pagina" class="btn btn-default btn-sm"><i class="fa fa-pen"></i></a>@endcan
									@can('gp_pagina_eliminar')<a href="eliminarpag/{{ $not->id_pagina }}" title="Eliminar pagina" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>@endcan
								<small class="badge-info" style="padding-left: 4px; padding-right:4px; border-radius: 4px;">{{ $dirul }}/pagina/{{ $not->id_pagina }}</small>
								</td>
							</tr>	
							@empty
								
							@endforelse
						</tbody>
                    </table>
                    {{-- @php
                        print_r($datospag);
                    @endphp --}}
				</div>
				<div class="card-footer clearfix">
	               {{ $datospag->links() }} 
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

	@if(Session::has('eliminadopag'))
		toastr.error('{{ Session::get('eliminadopag') }}')
	@endif
</script>
@endsection

