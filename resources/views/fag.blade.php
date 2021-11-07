@extends('plantillas.admin')

@section('titulopagina')
	Portalweb | FAG
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Registro de FAG
      <small></small>
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">FAG</li>
    </ol>
  </div>
@endsection

@section('contenido')
{{-- <div class="row p-2">
	<a href="newpublicaciones" class="btn btn-sm btn-primary">Crear publicación</a>
</div> --}}

<div class="container-fluid">
    <div class="row">
        
            <div class="col-sm-4">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Nuevo Fondo de Apoyo Gerencial(FAG)</h3>
                    </div> <!-- /.card-body -->
                    <form class="form" method="post" action="{{ route('addfag') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="iddirweb"  value="{{ Auth::user()->iddirecciones_web }}"> --}}
                        <div class="card-body">					
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fecha</label>
                                <input type="date" class="form-control" name="fecha" placeholder="Ejem. publicacion, insttitucional" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Archivo en imgagen</label>
                                <input type="file" class="form-control" name="archivo" placeholder="Ejem. publicacion, insttitucional" required>
                            </div>
                            	                 
                        </div>
                        @can('gp_categoria_crear')
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm float-sm-right"><i class="fa fa-save"></i> Guardar</button>
                        </div>
                        @endcan
                    </form>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card card-dark card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Listado de FAG</h3>
                    </div>
                    <div class="card-body">
                        {{-- @php
                        print_r($datos);
                        @endphp --}}
                        
                        
                        <table class="table table-bordered table-sm table-hover ">
                            <thead class="bg-secondary">
                                <tr><th>Id</th><th>año</th><th>mes</th><th>archivo img</th><th>Acciones</th></tr>
                            </thead>
                            <tbody>
                                @foreach($datos as $cat)
                                <tr><td>{{ $cat->idfag }}</td><td>{{ $cat->ano }}</td><td>{{ $cat->mes }}</td><td>{{ $cat->img }}</td><td nowrap>
                                    
                                    @can('gp_anuncios_editar')<a href="#" class="btn btn-sm btn-default" title="Editar" data-toggle="modal" data-target="#editpopup" onclick="cargardatos({{ $cat->idfag }})"><i class="fa fa-edit"></i></a>@endcan
                                    @can('gp_anuncios_eliminar')<a href="/eliminarfag/{{ $cat->idfag }}" class="btn btn-sm btn-default" title="Eliminar"><i class="fa fa-trash"></i></a>@endcan
                                    </td></tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="card-footer clearfix">
                    {{ $datos->links() }}
                </div>
                </div>
                
            </div>
        
        
    </div>
</div>



@endsection

@section('script')

<script type="text/javascript">

	// $('input[type=radio][name=tieneweb]').change(function() {
 //    if (this.value== 'SI') {$('#dominiogore').show();$('#dominioext').hide();}
 //    else{$('#dominioext').show();$('#dominiogore').hide();}
	// });
	$("ul.pagination").addClass('pagination-sm m-0 float-right');

</script>

<script type="text/javascript">
    @if(Session::has('success'))
       toastr.success('{{ Session::get('success') }}')
    @endif//

    @if(Session::has('archivoeliminado'))
       toastr.error('{{ Session::get('archivoeliminado') }}')
    @endif

</script>

@endsection
