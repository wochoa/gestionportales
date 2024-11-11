@extends('plantillas.admin')

@section('titulopagina')
	Portalweb | Videos
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Registro Videos
      <small></small>
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">Videos</li>
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
                        <h3 class="card-title">Nuevo registro de Videos</h3>
                    </div> <!-- /.card-body -->
                    <form class="form" method="post" action="{{ route('addregvideos') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="iddirweb"  value="{{ Auth::user()->iddirecciones_web }}"> --}}
                        <div class="card-body">					
                            <div class="form-group">
                                <label for="exampleInputEmail1">Título de videos</label>
                                <input type="text" class="form-control" name="titulo" placeholder="Ejem. Poder judicial" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Url youtube</label>
                                <input type="text" class="form-control" name="url" placeholder="Ejem. https://www.youtube.com/watch?v=WBXBMXDqmnk" required>
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Enlace de referencia</label>
                                <input type="text" class="form-control" name="url" placeholder="Ejem. http://www.minedu.gob.pe" required>
                            </div> --}}
                            	                 
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
                        <h3 class="card-title">Listado de Videos</h3>
                    </div>
                    <div class="card-body">
                        {{-- @php
                        print_r($datos);
                        @endphp --}}
                        
                        
                        <table class="table table-bordered table-sm table-hover ">
                            <thead class="bg-secondary">
                                <tr><th>Id</th><th>Titulo</th><th>Enlace</th><th>Activo</th><th>Fecha creacion</th><th>Acciones</th></tr>
                            </thead>
                            <tbody>
                                @foreach($videos as $enref)
                                <tr><td>{{ $enref->id }}</td><td>{{ $enref->titulo }}</td><td>{{ $enref->url }}</td><td>
                                    
                                    @if($enref->estado==1)
                                    <a href="/desactivavideos/{{ $enref->id }}"><i class="fa fa-toggle-on"></i></a>
                                    @else
                                    <a href="/activavideos/{{ $enref->id }}"><i class="fa fa-toggle-off"></i></a>
                                @endif
                                
                                </td><td>{{ $enref->created_at }}</td><td>
                                    @can('gp_video_editar')<a href="#" class="btn btn-sm btn-default" title="Editar" onclick="cargardatos({{ $enref->id }})" data-toggle="modal" data-target="#editenlace"><i class="fa fa-edit"></i></a>@endcan
                                    @can('gp_video_eliminar')<a href="/elimnavideos/{{ $enref->id }}" class="btn btn-sm btn-default" title="Eliminar"><i class="fa fa-trash"></i></a>@endcan    
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
		<form class="form" method="post" action="{{ route('editvideo') }}">
            @csrf
            <input type="hidden" name="id" id="id" value="">
            <div class="card-body">					
                <div class="form-group">
                    <label for="exampleInputEmail1">TITULO</label>
                    <input type="text" class="form-control" name="titulop" id="titulop" placeholder="Ejem. Audiencia, vacunacion contra el covid19" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Url </label>
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
    
    @if(Session::has('newvideos'))
       toastr.success('{{ Session::get('newvideos') }}')
    @endif

    @if(Session::has('desactivavideos'))
       toastr.error('{{ Session::get('desactivavideos') }}')
    @endif

    @if(Session::has('activavideos'))
       toastr.success('{{ Session::get('activavideos') }}')
    @endif

    @if(Session::has('elimnavideos'))
       toastr.error('{{ Session::get('elimnavideos') }}')
    @endif    
    
    @if(Session::has('updatevideo'))
       toastr.error('{{ Session::get('updatevideo') }}')
    @endif

</script>

<script>
    function cargardatos(id)
    {
        var id=id;
		$("#id").val(id);
		//alert(id);
		$.ajax({      
        // data: {reg:region},
        url: '/datovideo/'+id,
        type: 'get',
        dataType : 'json',        
        success: function(data){ 

         $("#titulop").val(data[0].titulo);
         $("#urlp").val(data[0].url);
		  
        },
        error: function(X){
              alert("ha ocurrido un error");            
          },
      });
    }
</script>
@endsection
