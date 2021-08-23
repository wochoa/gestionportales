@extends('plantillas.admin')
@section('titulopagina')
	Portalweb | Reporte de visitas
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
      <li class="breadcrumb-item active">Resporte visita</li>
    </ol>
  </div>
@endsection

@section('contenido')
<div class="container-fluid">

	

<div class="row">
	
		<div class="col-sm-12">
			<div class="card card-primary card-outline">
				<div class="card-header">
		            <h3 class="card-title">Listado de Vistas</h3>
		         </div> <!-- /.card-body -->
				<div class="card-body">
					<table class="table table-hover table-sm table-bordered">
						<thead>
							<tr><th>ID</th><th>DNI</th><th>NOMBRE</th><th>FECHA INGRESO</th><th>OFICINA</th><th>FECHA SALIDA</th><th>ASUNTO</th></tr>
						</thead>
						<tbody>
							@forelse($regvisita as $key)
								<tr>
									<td>{{ $key->idregvisita }}</td>
									<td>{{ $key->dni }}</td>
									<td>{{ $key->nombre }}</td>
									<td>{{ $key->fechaingreso }}</td>
									<td>{{ $key->nom_oficina }}</td>
									<td>{{ $key->fechasalida }}</td>
									<td>{{ $key->motivo }}</td>
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
	               {{ $regvisita->links() }} 
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

