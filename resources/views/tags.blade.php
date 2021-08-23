@extends('plantillas.admin')

@section('titulopagina')
	Portalweb | tags
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Registro de tags
      <small></small>
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">tags</li>
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
                        <h3 class="card-title">Nueva nueva tags para publicaciones y pagina web general</h3>
                    </div> <!-- /.card-body -->
                    <form class="form" method="post" action="{{ route('addregtags') }}">
                        @csrf
                        {{-- <input type="hidden" name="iddirweb"  value="{{ Auth::user()->iddirecciones_web }}"> --}}
                        <div class="card-body">					
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre de la tags</label>
                                <input type="text" class="form-control" name="nomtags" placeholder="Ejem. publicacion, insttitucional" required>
                            </div>
                            	                 
                        </div>
                        @can('gp_taspagina_crear')
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
                        <h3 class="card-title">Listado de tags</h3>
                    </div>
                    <div class="card-body">
                        {{-- @php
                        print_r($datos);
                        @endphp --}}
                        
                        
                        <table class="table table-bordered table-sm table-hover ">
                            <thead class="bg-secondary">
                                <tr><th>Id</th><th>Nombre</th><th>Fecha creacion</th><th>Acciones</th></tr>
                            </thead>
                            <tbody>
                                @foreach($datos as $cat)
                                <tr><td>{{ $cat->idtags }}</td><td>{{ $cat->nom_tags }}</td><td>{{ $cat->created_at }}</td><td>ss</td></tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="card-footer clearfix">
                    {{-- {{ $datos->links() }} --}}
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
@endif

</script>

@endsection
