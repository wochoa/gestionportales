@extends('plantillas.admin')

@section('titulopagina')
	Portalweb | menu
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Registro de menus
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
					<h3 class="card-title">Menu superior principal</h3>
					@can('gp_menu_crear')
					<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#newmenu">
						Agregar menu principal
					</button>
					@endcan
		         </div> <!-- /.card-body -->
			      
					<div class="card-body">					
						<table class="table table-sm table-bordered">
							<thead>
								<th>N</th><th>Menu principal</th><th>Activo</th><th>Acciones</th>
							</thead>
							<tbody>
								@foreach($datosmenu as $mnp)
									<tr><td>{{ $mnp->idmenus }}</td><td>{{ $mnp->nom_menu }}</td><td>
										@if($mnp->activo_menu==1)
										<a href="/desactivarmp/{{ $mnp->idmenus }}"><i class="fa fa-toggle-on"></i></a>
										@else
										<a href="/activarmp/{{ $mnp->idmenus }}"><i class="fa fa-toggle-off"></i></a>
										@endif
									</td><td>
										@can('gp_menu_editar')<a href="#" onclick="cargardatmenu({{ $mnp->idmenus }})" data-toggle="modal" data-target="#editmenu"><i class="fa fa-edit"></i></a>@endcan
										@can('gp_menu_eliminar')<a href="#"><i class="fa fa-trash"></i></a>@endcan
									</td></tr>
								@endforeach
							</tbody>
						</table>               
					</div>
						              
			</div>
		</div>
		<div class="col-sm-8">
			<div class="card card-dark card-outline">
				<div class="card-header">
					<h3 class="card-title">Listado de sub menus</h3>
					@can('gp_menu_crear')
					<button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#newsubmenu">
						Agregar de sub menus
					  </button>
					@endcan
		         </div>
				<div class="card-body">
					@php
					//print_r($datos);
					@endphp
					
					 
					 <table class="table table-bordered table-sm table-hover ">
					 	<thead class="bg-secondary">
					 		<tr><th>Id</th><th>Sub menú</th><th>idmenu principal</th><th>Activo</th><th>Acciones</th></tr>
					 	</thead>
					 	<tbody>
					 		@foreach($datossubmenu as $datsubmenu)
					 		<tr><td>{{ $datsubmenu->idsubmenu }}</td><td>{!! $datsubmenu->nom_submenu !!}</td><td>{{ $datsubmenu->idmenus }}</td><td>
								 @if($datsubmenu->activo_submenu==1)
										<a href="/desactivarmpsub/{{ $datsubmenu->idsubmenu }}"><i class="fa fa-toggle-on"></i></a>
										@else
										<a href="/activarmpsub/{{ $datsubmenu->idsubmenu }}"><i class="fa fa-toggle-off"></i></a>
										@endif
								</td></td><td>
									@can('gp_menu_editar')<a href="#" onclick="cargardatsubmenu({{ $datsubmenu->idsubmenu }})" data-toggle="modal" data-target="#editsubmenu"><i class="fa fa-edit"></i></a>@endcan
									@can('gp_menu_eliminar')<a href="#"><i class="fa fa-trash"></i></a>@endcan
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

{{-- modal nuevo menus --}}
  <div class="modal fade" id="newmenu">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuevo menu principal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form" method="post" action="{{ route('formregmenu') }}">
			@csrf
		  <div class="card-body">					
			  <div class="form-group">
				  <label for="exampleInputEmail1">Ingrese el menú a visualizar en la página web</label>
				  <input type="text" class="form-control" name="nomdireccion" placeholder="Ejem. Institucional, Documentos, Convocatorias,etc" required>
			   </div>
			   <div class="form-group">
				  <label for="exampleInputEmail1">El menú a crear contendrá sub menús?</label>
				  <div class="form-check">
					<input class="form-check-input" type="radio" name="tieneweb" value="SI">
					<label class="form-check-label">SI</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input class="form-check-input" type="radio" name="tieneweb" value="NO">
					<label class="form-check-label">NO</label>
				  </div>
			   </div>
			   <div class="form-group" style="display: none;" id="dominiogore">
				  <label for="exampleInputEmail1">Su enlace por defecto será(#)</label>
				  <input type="hidden" class="form-control" name="enlacesi" value="#"  placeholder="#">
			   </div>
			   <div class="form-group row" style="display: none;" id="dominioext">
				 <div class="col-sm-12">
					<div class="form-group" >
						<label for="exampleInputEmail1"><span class="badge badge-info left">A</span>	Talvez quieras incorporar una página creada(En el Módulo página)</label>
						<select class="form-control col-sm-12" name="idpagina" id="idpagina">
							<option value="">Seleccione la pagina creada</option>
							@foreach($datospag as $key)
							<option value="{{ $key->id_pagina }}">{{ $key->nom_pagina }}</option>
								
							@endforeach
							<option value="">Ninguno pagina</option>
						</select>
					 </div>
				 </div>
				 <div class="col-sm-12">
					<div class="form-group" >
						<label for="exampleInputEmail1"><span class="badge badge-info left">B</span> Ingrese la url </label>
						<input type="text" class="form-control" name="url" id="url" placeholder="Ejem. http://www.huanucoagrario.gob.pe/">
					 </div>
				 </div>
				 <div class="col-sm-12">
					<div class="form-group" >
						<h3>Nota</h3>
						<p>El punto A en considerado prioridad, si en ambos casos es rellenado el contenido, pero si no seleccionas ninguna página de lista del punto A y rellenas el punto B, entonces se considerará el punto B como prioridad</p>
					 </div>
				 </div>

				 
			   </div>
			   
			   	                 
		  </div>
		  <div class="card-footer">
			<button type="submit" class="btn btn-primary btn-sm float-sm-right"><i class="fa fa-save"></i> Guardar</button>
		  </div>
		</form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
{{-- edit menu --}}
<div class="modal fade" id="editmenu">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuevo menu principal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form" method="post" action="{{ route('formregmenuedit') }}">
			@csrf
			<input type="hidden" name="idmenuedit" id="idmenuedit">
		  <div class="card-body">					
			  <div class="form-group">
				  <label for="exampleInputEmail1">Ingrese el menú a visualizar en la página web</label>
				  <input type="text" class="form-control" name="editnommenu" id="editnommenu" placeholder="Ejem. Institucional, Documentos, Convocatorias,etc" required>
			   </div>
			   <div class="form-group">
				  <label for="exampleInputEmail1">El menú a crear contendrá sub menús?</label>
				  <div class="form-check">
					<input class="form-check-input" type="radio" name="contiensub" id="contiensub1" value="SI">
					<label class="form-check-label">SI</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input class="form-check-input" type="radio" name="contiensub" id="contiensub2" value="NO">
					<label class="form-check-label">NO</label>
				  </div>
			   </div>
			   <div class="form-group" style="display: none;" >
				  <label for="exampleInputEmail1">Su enlace por defecto será(#)</label>
				  <input type="hidden" class="form-control" name="enlacesi" id="enlacesi" placeholder="#">
			   </div>
			   <div class="form-group row" style="display: none;" id="divcontsubmenu">
				 <div class="col-sm-12">
					<div class="form-group" >
						<label for="exampleInputEmail1"><span class="badge badge-info left">A</span>	Talvez quieras incorporar una página creada(En el Módulo página)</label>
						<select class="form-control col-sm-12" name="idpaginaedit" id="idpaginaedit">
							<option value="">Seleccione la pagina creada</option>
							@foreach($datospag as $key)
							<option value="{{ $key->id_pagina }}">{{ $key->nom_pagina }}</option>
								
							@endforeach
							<option value="">Ninguno pagina</option>
						</select>
					 </div>
				 </div>
				 <div class="col-sm-12">
					<div class="form-group" >
						<label for="exampleInputEmail1"><span class="badge badge-info left">B</span> Ingrese la url </label>
						<input type="text" class="form-control" name="urledit" id="urledit" placeholder="Ejem. http://www.huanucoagrario.gob.pe/">
					 </div>
				 </div>
				 <div class="col-sm-12">
					<div class="form-group" >
						<h3>Nota</h3>
						<p>El punto A en considerado prioridad, si en ambos casos es rellenado el contenido, pero si no seleccionas ninguna página de lista del punto A y rellenas el punto B, entonces se considerará el punto B como prioridad</p>
					 </div>
				 </div>

				 
			   </div>
			   
			   	                 
		  </div>
		  <div class="card-footer">
			<button type="submit" class="btn btn-primary btn-sm float-sm-right"><i class="fa fa-save"></i> Guardar</button>
		  </div>
		</form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
{{-- modal nuevo sub menu --}}
<div class="modal fade" id="newsubmenu">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuevo submenu</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form" method="post" action="{{ route('formregsubmenu') }}">
			@csrf
		  <div class="card-body">					
			  <div class="form-group">
				  <label for="exampleInputEmail1">Ingrese el sub menú a visualizar en la página web</label>
				  <input type="text" class="form-control" name="nomsubmenu" placeholder="Ejem. Autoridades, Mision y Vision, organigrama,etc" required>
			   </div>
			   <div class="form-group" >
				<label for="exampleInputEmail1">Seleccione el menu principal</label>
				<select class="form-control col-sm-12" name="idmenus" id="idmenus" required>
					<option value="">Seleccione menu creado</option>
					@foreach($datosmenu as $key2)
					 @if($key2->link_menu=="#" and $key2->activo_menu==1)
					 <option value="{{ $key2->idmenus }}">{{ $key2->nom_menu }}</option>
					 @endif	
					@endforeach
					
				</select>
			   </div>
			   <div class="form-group">
				  <label for="exampleInputEmail1">El submenú a crear tendrá enlace externo?</label>
				  <div class="form-check">
					<input class="form-check-input" type="radio" name="enlaceexterno" value="SI">
					<label class="form-check-label">SI</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input class="form-check-input" type="radio" name="enlaceexterno" value="NO">
					<label class="form-check-label">NO</label>
				  </div>
			   </div>
			   <div class="form-group" style="display: none;" id="divetxtenosi">
				  <label for="exampleInputEmail1">Ingrese la direccion url</label>
				  <input type="text" class="form-control" name="enlcaesiessi" id="enlcaesiessi" placeholder="http://www.minedu.gob.pe">
			   </div>
			   <div class="form-group row" style="display: none;" id="divetxtenono">
				 <div class="col-sm-12">
					<div class="form-group" >
						<label for="exampleInputEmail1"><span class="badge badge-info left">A</span>	Talvez quieras incorporar una página creada(En el Módulo página)</label>
						<select class="form-control col-sm-12" name="idpaginaparasub" id="idpaginaparasub">
							<option value="">Seleccione la pagina creada</option>
							@foreach($datospag as $key)
							<option value="{{ $key->id_pagina }}">{{ $key->nom_pagina }}</option>
								
							@endforeach
							
						</select>
					 </div>
				 </div>
				 

				 
			   </div>
			   
			   	                 
		  </div>
		  <div class="card-footer">
			<button type="submit" class="btn btn-primary btn-sm float-sm-right"><i class="fa fa-save"></i> Guardar</button>
		  </div>
		</form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{-- modal editar sub menu --}}
<div class="modal fade" id="editsubmenu">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar submenu</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form" method="post" action="{{ route('formregsubmenuedit') }}">
			@csrf
			<input type="hidden" name="idsubmenuedit" id="idsubmenuedit">
		  <div class="card-body">					
			  <div class="form-group">
				  <label for="exampleInputEmail1">Ingrese el sub menú a visualizar en la página web</label>
				  <input type="text" class="form-control" name="nomsubmenuedit"id="nomsubmenuedit" placeholder="Ejem. Autoridades, Mision y Vision, organigrama,etc" required>
			   </div>
			   <div class="form-group" >
				<label for="exampleInputEmail1">Seleccione el menu principal</label>
				<select class="form-control col-sm-12" name="editidmenussub" id="editidmenussub" required>
					<option value="">Seleccione menu creado</option>
					@foreach($datosmenu as $key2)
					 @if($key2->link_menu=="#")
					 <option value="{{ $key2->idmenus }}">{{ $key2->nom_menu }}</option>
					 @endif	
					@endforeach
					
				</select>
			   </div>
			   <div class="form-group">
				  <label for="exampleInputEmail1">El submenú a crear tendrá enlace externo?</label>
				  <div class="form-check">
					<input class="form-check-input" type="radio" name="enlaceexternoedit" id="enlaceexternoedit1" value="SI">
					<label class="form-check-label">SI</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input class="form-check-input" type="radio" name="enlaceexternoedit"id="enlaceexternoedit2"  value="NO">
					<label class="form-check-label">NO</label>
				  </div>
			   </div>
			   <div class="form-group" style="display: none;" id="divetxtenosiedit">
				  <label for="exampleInputEmail1">Ingrese la direccion url</label>
				  <input type="text" class="form-control" name="enlcaesiessiedit" id="enlcaesiessiedit" placeholder="http://www.minedu.gob.pe">
			   </div>
			   <div class="form-group row" style="display: none;" id="divetxtenonoedit">
				 <div class="col-sm-12">
					<div class="form-group" >
						<label for="exampleInputEmail1"><span class="badge badge-info left">A</span>	Talvez quieras incorporar una página creada(En el Módulo página)</label>
						<select class="form-control col-sm-12" name="idpaginaparasubedit" id="idpaginaparasubedit">
							<option value="">Seleccione la pagina creada</option>
							@foreach($datospag as $key)
							<option value="{{ $key->id_pagina }}">{{ $key->nom_pagina }}</option>
								
							@endforeach
						</select>
					 </div>
				 </div> 
			   </div>	   
			   	                 
		  </div>
		  <div class="card-footer">
			<button type="submit" class="btn btn-primary btn-sm float-sm-right"><i class="fa fa-save"></i> Guardar</button>
		  </div>
		</form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection

@section('script')

<script type="text/javascript">

	// $('input[type=radio][name=tieneweb]').change(function() {
 	//    if (this.value== 'SI') {$('#dominiogore').show();$('#dominioext').hide();}
 	//    else{$('#dominioext').show();$('#dominiogore').hide();}
	// });
	$("ul.pagination").addClass('pagination-sm m-0 float-right');


	// seccion para crear menu
	$('input[type=radio][name=tieneweb]').change(function() {
    if (this.value== 'SI') {$('#dominiogore').hide();$('#dominioext').hide();$("#url").val(null);$("#idpagina").val(null)}
    else{$('#dominioext').show();$('#dominiogore').hide();}
	});
	$("ul.pagination").addClass('pagination-sm m-0 float-right');

	//seccion para crear sub menu
	$('input[type=radio][name=enlaceexterno]').change(function() {
    if (this.value== 'SI') {$('#divetxtenosi').show();$('#divetxtenono').hide();$("#idpaginaparasub").val(null)}
    else{$('#divetxtenono').show();$('#divetxtenosi').hide();$("#enlcaesiessi").val(null);}
	});
	// $("ul.pagination").addClass('pagination-sm m-0 float-right');

</script>

<script type="text/javascript">
	@if(Session::has('newmenu'))
       toastr.success('{{ Session::get('newmenu') }}')
    @endif

	@if(Session::has('activarmenu'))
       toastr.info('{{ Session::get('activarmenu') }}')
    @endif

	@if(Session::has('desactivarmenu'))
       toastr.error('{{ Session::get('desactivarmenu') }}')
    @endif

	@if(Session::has('newsubmenu'))
       toastr.success('{{ Session::get('newsubmenu') }}')
    @endif

	@if(Session::has('activarmenusub'))
       toastr.info('{{ Session::get('activarmenusub') }}')
    @endif

	@if(Session::has('desactivarmenusub'))
       toastr.error('{{ Session::get('desactivarmenusub') }}')
    @endif

	@if(Session::has('updmenu'))
       toastr.success('{{ Session::get('updmenu') }}')
    @endif

	@if(Session::has('editsubmenu'))
       toastr.success('{{ Session::get('editsubmenu') }}')
    @endif
	
	
	
	// para editar menu
	$('input[type=radio][name=contiensub]').change(function() {
    if (this.value== 'SI') {$("#divcontsubmenu").hide();$("#urledit").val(null);$("#enlacesi").val("#");}
    else{$("#divcontsubmenu").show();$("#enlacesi").val(null);}
	});

	// para editar sub menu
	$('input[type=radio][name=enlaceexternoedit]').change(function() {
    if (this.value== 'SI') {$('#divetxtenosiedit').show();$('#divetxtenonoedit').hide();$("#idpaginaparasubedit").val(null)}
    else{$('#divetxtenonoedit').show();$('#divetxtenosiedit').hide();$("#enlcaesiessiedit").val(null);}
	});

</script>

<script>
	function cargardatmenu(id)
	{
		//alert(id);
		$("#idmenuedit").val(id);
		$.ajax({      
        // data: {reg:region},
        url: '/datoeditarmenu/'+id,
        type: 'get',
        dataType : 'json',        
        success: function(data){ 

          $("#editnommenu").val(data[0].nom_menu);

		  if(data[0].link_menu=="#"){$('#contiensub1').prop("checked",true);$("#divcontsubmenu").hide();}
		  else{$('#contiensub2').prop("checked",true);$("#divcontsubmenu").show();}
		  
		  $("#enlacesi").val(data[0].link_menu);
		  $("#idpaginaedit").val(data[0].id_pagina);
		  $("#urledit").val(data[0].link_menu);
        },
        error: function(X){
              alert("ha ocurrido un error");            
          },
      });
	}

	function cargardatsubmenu(id)
	{
		$("#idsubmenuedit").val(id);
		$.ajax({      
        // data: {reg:region},
        url: '/datoeditarsubmenu/'+id,
        type: 'get',
        dataType : 'json',        
        success: function(data){ 

          $("#nomsubmenuedit").val(data[0].nom_submenu);

		  if(data[0].link_submenu==""){$('#enlaceexternoedit2').prop("checked",true);$("#divetxtenosiedit").hide();$("#divetxtenonoedit").show();}
		  else{$('#enlaceexternoedit1').prop("checked",true);$("#divetxtenosiedit").show();$("#divetxtenonoedit").hide();}
		  
		  $("#editidmenussub").val(data[0].idmenus);
		  $("#enlcaesiessiedit").val(data[0].link_submenu);
		  $("#idpaginaparasubedit").val(data[0].idpagina);
		 
        },
        error: function(X){
              alert("ha ocurrido un error");            
          },
      });
	}

</script>

@endsection
