@extends('plantillas.admin')

@section('titulopagina')
	Portalweb | enlace referencial
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Registro enlace referencial
      <small></small>
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">enlace referencial</li>
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
                        <h3 class="card-title">Nuevo registro de enlace referencial</h3>
                    </div> <!-- /.card-body -->
                    <form class="form" method="post" action="{{ route('addregenlaceref') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="iddirweb"  value="{{ Auth::user()->iddirecciones_web }}"> --}}
                        <div class="card-body">					
                            <div class="form-group">
                                <label for="exampleInputEmail1">Entidad de referencia</label>
                                <input type="text" class="form-control" name="entidad" placeholder="Ejem. Poder judicial" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Imagen de referencia</label>
                                <input type="file" class="form-control" name="imagen" placeholder="Ejem. tamaño" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enlace de referencia</label>
                                <input type="text" class="form-control" name="url" placeholder="Ejem. http://www.minedu.gob.pe" required>
                            </div>
                            	                 
                        </div>
                        @can('gp_enlaceref_crear')
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
                        <h3 class="card-title">Listado de enlace referencial</h3>
                    </div>
                    <div class="card-body">
                        {{-- @php
                        print_r($datos);
                        @endphp --}}
                        
                        
                        <table class="table table-bordered table-sm table-hover ">
                            <thead class="bg-secondary">
                                <tr><th>Id</th><th>Entidad</th><th>Enlace</th><th>Activo</th><th>Fecha creacion</th><th>Acciones</th></tr>
                            </thead>
                            <tbody>
                                @foreach($enlaceref as $enref)
                                <tr><td>{{ $enref->idenlacerefe }}</td><td>{{ $enref->entidad_ref }}</td><td>{{ $enref->link_refe }}</td><td>
                                    
                                    @if($enref->activo_refe==1)
                                    <a href="/desactivarefe/{{ $enref->idenlacerefe }}"><i class="fa fa-toggle-on"></i></a>
                                    @else
                                    <a href="/activarefe/{{ $enref->idenlacerefe }}"><i class="fa fa-toggle-off"></i></a>
                                @endif
                                
                                </td><td>{{ $enref->created_at }}</td><td>
                                    @can('gp_enlaceref_editar')<a href="#" class="btn btn-sm btn-default" title="Editar" onclick="cargar({{ $enref->idenlacerefe }})" data-toggle="modal" data-target="#editenlace"><i class="fa fa-edit"></i></a>@endcan
                                    @can('gp_enlaceref_eliminar')<a href="/elimnarefe/{{ $enref->idenlacerefe }}" class="btn btn-sm btn-default" title="Eliminar"><i class="fa fa-trash"></i></a>@endcan    
                                </td></tr>
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

<!-- Modal editar popup -->
<div class="modal fade" id="editenlace" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop='static'>
	<div class="modal-dialog">
	  <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar publicacion emergente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
		<form class="form" method="post" action="{{ route('editpopup') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="idpopup" id="idpopup" value="">
            <div class="card-body">					
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre de la ventana emeregente</label>
                    <input type="text" class="form-control" name="nombrep" id="nombrep" placeholder="Ejem. Audiencia, vacunacion contra el covid19" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Insertar imagen</label>
                    <input type="file" class="form-control" name="imgpopupp" id="imgpopupp" accept=".jpg,.jpeg,.png" >
                    <span id="imgp"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Url para mas información</label>
                    <input type="text" class="form-control" name="urlp" id="urlp" placeholder="Recomendacion: url de google drive" required>
                    <span>Para colocar la url de google drive se necesita cargar el archivo y luego de compartir para todo el publico</span>
                </div>
                                     
            </div>
            <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm float-sm-right"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </form>
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
    
    @if(Session::has('newenlaceref'))
       toastr.success('{{ Session::get('newenlaceref') }}')
    @endif

    @if(Session::has('desactivarefe'))
       toastr.error('{{ Session::get('desactivarefe') }}')
    @endif

    @if(Session::has('activarefe'))
       toastr.success('{{ Session::get('activarefe') }}')
    @endif

    @if(Session::has('eliminadoref'))
       toastr.error('{{ Session::get('eliminadoref') }}')
    @endif

    

</script>

@endsection
