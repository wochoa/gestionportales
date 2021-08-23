@extends('plantillas.admin')

@section('titulopagina')
	Administrador | portales
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Registro de páginas web
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
{{-- <div class="row p-2">
	<a href="newpublicaciones" class="btn btn-sm btn-primary">Crear publicación</a>
</div> --}}
	

<div class="row">
	
		<div class="col-sm-4">
			<div class="card card-primary card-outline">
				<div class="card-header">
		            <h3 class="card-title">Nueva página web</h3>
		         </div> <!-- /.card-body -->
			      <form class="form" method="post" action="{{ route('formregistropagina') }}">
			      	@csrf
					<div class="card-body">
						<div class="form-group">
							<label for="">Dependencia</label>
							<select name="nomdepe" id="nomdepe" class="form-control form-control-sm">
								@for($i = 0; $i < count($datosdepe); $i++)
									{{-- @if($datosdepe[$i]["iddepe"]==$depe_id)
									<option value="{{ $datosdepe[$i]["iddepe"]}}" selected="selected">{{ $datosdepe[$i]["nombredebe"]}}</option> 
									@else --}}
									<option value="{{ $datosdepe[$i]["iddepe"]}}">{{ $datosdepe[$i]["nombredebe"]}}</option>
									{{-- @endif  --}}
								@endfor
							</select>
						</div>					
						<div class="form-group">
		                    <label for="exampleInputEmail1">Nombre de la dirección</label>
		                    <input type="text" class="form-control form-control-sm" name="nomdireccion" placeholder="Ejem. Dirección Regional de producción" required>
		                 </div>
		                 <div class="form-group">
		                    <label for="exampleInputEmail1">La direccion esta dentro del dominio de regionhuanuco.gob.pe</label>
		                    <div class="form-check">
	                          <input class="form-check-input" type="radio" name="tieneweb" value="SI">
	                          <label class="form-check-label">SI</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                          <input class="form-check-input" type="radio" name="tieneweb" value="NO">
	                          <label class="form-check-label">NO</label>
	                        </div>
		                 </div>
		                 <div class="form-group" style="display: none;" id="dominiogore">
		                    <label for="exampleInputEmail1">Ingrese el nombre del dominio(xxxxx.regionhuanuco.gob.pe)</label>
		                    <input type="text" class="form-control" name="dominiogore"  placeholder="Ejem. http://consejoregional.regionhuanuco.gob.pe">
		                 </div>
		                 <div class="form-group" style="display: none;" id="dominioext">
		                    <label for="exampleInputEmail1">Ingrese el nombre del dominio propio</label>
		                    <input type="text" class="form-control" name="dominioext" placeholder="Ejem. http://www.huanucoagrario.gob.pe/">
		                 </div>	                 
					</div>
					<div class="card-footer">
	                  <button type="submit" class="btn btn-primary btn-sm float-sm-right"><i class="fa fa-save"></i> Guardar</button>
	                </div>
	              </form>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="card card-dark card-outline">
				<div class="card-header">
		            <h3 class="card-title">Listado de Páginas</h3>
		         </div>
				<div class="card-body">
					@php
					//print_r($datos);
					@endphp
					
					 
					 <table class="table table-bordered table-sm table-hover ">
					 	<thead class="bg-secondary">
					 		<tr><th>Id</th><th>Nombre</th><th>Link externo</th><th>Dominio Gore</th><th></th></tr>
					 	</thead>
					 	<tbody>
					 		@foreach($datos as $dirweb)
					 		<tr><td>{{ $dirweb->iddirecciones_web }}</td><td>{!! utf8_encode($dirweb->nom_direcciones_web) !!}</td><td>{{ $dirweb->linkdirecciones_web }}</td><td>{{ $dirweb->dns_direcciones_web }}</td><td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#editar"><i class="fa fa-edit"></i></button></td></tr>
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

{{-- /// modal --}}
{{-- <div class="modal fade" id="editar">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuevo permiso</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form" method="post" action="{{ route('addpermiso') }}">
            @csrf
            <input type="hidden" name="iddirweb"  value="{{ Auth::user()->iddirecciones_web }}">
            <div class="card-body">					
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre de permiso</label>
                    <input type="text" class="form-control" name="nompermiso" placeholder="Ejem. Dashboard" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre de URL</label> <span>poner url si es unico(sino tiene sub menus) de lo contrario en blanco</span>
                    <input type="text" class="form-control" name="url" placeholder="Ejem. name('xxxx') las xxx se debe colocar">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">URl enlace(ref=)</label> 
                  <input type="text" class="form-control" name="urlrefdir" placeholder="Ejem. /ejemplo/residuos">
              </div>
                                        
            </div>
            <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm float-sm-right"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </form>
      </div>
      
    </div>
    
  </div> --}}
@endsection

@section('script')

<script type="text/javascript">

	$('input[type=radio][name=tieneweb]').change(function() {
    if (this.value== 'SI') {$('#dominiogore').show();$('#dominioext').hide();}
    else{$('#dominioext').show();$('#dominiogore').hide();}
	});
	$("ul.pagination").addClass('pagination-sm m-0 float-right');

</script>

@endsection
