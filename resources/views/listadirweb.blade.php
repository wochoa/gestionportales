@extends('plantillas.admin')
@section('titulopagina')
	Portalweb | Reporte de visitas
@endsection
@section('titulosuperior')
<div class="col-sm-6">
    <h1>
     Listado de direcciones para reportes de visitas
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
                        <tr><th>ID</th><th>DEPENDENCIA/UNIDAD</th><th>Enlace visitas</th></tr>
                    </thead>
                    <tbody>
                        @forelse($listadrw as $key)
                            <tr>
                                <td>{{ $key->iddirecciones_web }}</td>
                                <td>{{ utf8_encode($key->nom_direcciones_web) }}</td>
                                <td><a href="{{ url('listado_extrenovisitas') }}/{{ $key->iddirecciones_web }}">{{ $key->dns_direcciones_web }}</a></td>
                               
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
                {{-- @php
                    print_r($datospag);
                @endphp --}}
            </div>
            {{-- <div class="card-footer clearfix">
               {{ $listadrw->links() }} 
            </div> --}}
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


