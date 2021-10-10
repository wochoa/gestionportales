@extends('plantillas.admin')

@section('titulopagina')
	Portalweb | slider
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Registro de slider
      <small></small>
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">Slider</li>
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
                        <h3 class="card-title">Nueva imagen slider</h3>
                    </div> <!-- /.card-body -->
                    <form class="form" method="post" action="{{ route('addrregslider') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="iddirweb"  value="{{ Auth::user()->iddirecciones_web }}"> --}}
                        <div class="card-body">					
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Nombre de la ventana emeregente</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Ejem. Audiencia, vacunacion contra el covid19" required>
                            </div> --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Insertar imagen</label>
                                <input type="file" class="form-control" name="imgpopup" accept=".jpg,.jpeg,.png"  required>
                                <span>Tamaño de imagen debe ser: 3390x715 pixeles</span>
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Url para mas información</label>
                                <input type="text" class="form-control" name="url" placeholder="Recomendacion: url de google drive" required>
                                <span>Para colocar la url de google drive se necesita cargar el archivo y luego de compartir para todo el publico</span>
                            </div> --}}
                            	                 
                        </div>
                        @can('gp_anuncios_crear')
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
                        <h3 class="card-title">Listado de slider</h3>
                    </div>
                    <div class="card-body">
                        {{-- @php
                        print_r($datos);
                        @endphp --}}
                        
                        
                        <table class="table table-bordered table-sm table-hover ">{{-- table-responsive --}}
                            <thead class="bg-secondary">
                                <tr>
                                    <th>Id</th>
                                    <th>imagen</th>
                                    <th>Fecha creacion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datoslider as $sli)
                                <tr>
                                    <td>{{ $sli->idslider }}</td>
                                    <td>{{ $sli->img_slider }}</td>
                                    <td>{{ $sli->created_at }}</td>
                                    <td nowrap>
                                        @if($sli->activo_slider==1)
                                            <a href="/desactivaslider/{{ $sli->idslider }}"><i class="fa fa-toggle-on"></i></a>
                                            @else
                                            <a href="/activaslider/{{ $sli->idslider }}"><i class="fa fa-toggle-off"></i></a>
                                        @endif
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        @can('gp_anuncios_editar')<a href="#" class="btn btn-sm btn-default" title="Editar" data-toggle="modal" data-target="#editslider" onclick="cargardatos({{ $sli->idslider }})"><i class="fa fa-edit"></i></a>@endcan
                                        @can('gp_anuncios_eliminar')<a href="/eliminapopup/{{ $sli->idslider }}" class="btn btn-sm btn-default" title="Eliminar"><i class="fa fa-trash"></i></a>@endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="card-footer clearfix">
                    {{ $datoslider->links() }}
                </div>
                </div>
            </div> 
        
    </div>
</div>

<!-- Modal editar popup -->
<div class="modal fade" id="editslider" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop='static'>
	<div class="modal-dialog">
	  <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar publicacion slider</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
		<form class="form" method="post" action="{{ route('editslider') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="idslider" id="idslider" value="">
            <div class="card-body">					
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Insertar imagen</label>
                    <input type="file" class="form-control" name="imgpopupp" id="imgpopupp" accept=".jpg,.jpeg,.png" >
                    <span id="imgp"></span>
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
    
    @if(Session::has('desactivapopup'))
       toastr.error('{{ Session::get('desactivapopup') }}')
    @endif
    
    @if(Session::has('activapopup'))
       toastr.info('{{ Session::get('activapopup') }}')
    @endif
    
    @if(Session::has('updatepopup'))
       toastr.success('{{ Session::get('updatepopup') }}')
    @endif

</script>
<script>
    function cargardatos(id)
    {
        var id=id;
		$("#idslider").val(id);
		//alert(id);
		$.ajax({      
        // data: {reg:region},
        url: '/datoslider/'+id,
        type: 'get',
        dataType : 'json',        
        success: function(data){ 

        //  $("#nombrep").val(data[0].titulopopup);
         $("#imgp").html(data[0].img_slider);
         
		  
        },
        error: function(X){
              alert("ha ocurrido un error");            
          },
      });
    }
</script>

@endsection
