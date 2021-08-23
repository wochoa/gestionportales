@extends('plantillas.admin')
@section('titulopagina')
	Portalweb | seccion
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Registro de secciones
      <small></small>
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">secciones</li>
    </ol>
  </div>
@endsection

@section('contenido')
{{-- <div class="row p-2">
	<a href="newpublicaciones" class="btn btn-sm btn-primary">Crear publicación</a>
</div> --}}

<div class="container-fluid">
    <div class="row">
        
            <div class="col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Nueva secciones</h3>
                    </div> <!-- /.card-body -->
                    <form class="form" method="post" action="{{ route('addregseccion') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="iddirweb"  value="{{ Auth::user()->iddirecciones_web }}"> --}}
                        <div class="card-body">	
                            <div class="form-group">
                                <label>Secciona a cargar informacion</label> <a href="{{ asset('dist/img/seccion.png') }}" target="_blank"><i class="fa fa-question"></i> Ver ayuda</a>
                                <select class="form-control form-control-sm select2" style="width: 100%;" name="seccion" id="seccion" required>
                                  <option value="">Seleccione la opcion</option>
                                  <option value="1">Seccion 1</option>
                                  <option value="2">Seccion 2</option>
                                  <option value="3">Seccion 3</option>
                                  <option value="4">Seccion 4</option>
                                  <option value="5">Seccion 5</option>

                                </select>
                              </div>				
                            <div class="form-group" id="titulo">
                                <label for="exampleInputEmail1">Html</label>
                                {{-- <input type="text" class="form-control form-control-sm" name="titulo" placeholder="Ejem. Plataformas" > --}}
                                <textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="titulo"></textarea>
                            </div>
                            <div class="form-group" id="texto_enlace">
                                <label for="exampleInputEmail1">Texto para el enlace</label>
                                <input type="text" class="form-control form-control-sm" name="texto_enlace" placeholder="Ejem. Sistema de gestion digital" >
                            </div>
                            <div class="form-group" id="url">
                                <label for="exampleInputEmail1">Url para el enlace</label>
                                <input type="text" class="form-control form-control-sm" name="Url" placeholder="Ejem. http://digtal.regionhuanuco.gob.pe" >
                            </div>
                            <div class="form-group" id="icono">
                                <label for="exampleInputEmail1">Icono para el enlace</label><span> <a href="https://fontawesome.com/icons?d=gallery" target="_blank">Ver icono</a></span>
                                <input type="text" class="form-control form-control-sm" name="icono" placeholder="Ejem. fa fa-edit" >
                            </div>
                            <div class="form-group" id="color">
                                <label for="exampleInputEmail1">Color para el enlace</label>
                                <select class="form-control form-control-sm " name="color">
                                    <option selected="selected" value="primary">Primary</option>
                                    <option value="success">Success</option>
                                    <option value="warning">Warning</option>
                                    <option value="danger">Danger</option>
                                    <option value="info">Info</option>
                                    <option value="secondary">Secondary</option>
                                    <option value="dark">Dark</option>
                                    <option value="gray">Gray</option>
  
                                  </select>
                            </div>
                            <div class="form-group" id="apartado">
                                <label for="exampleInputEmail1">Apartado</label> <span class="text-success">(para seccion 2(1,2 y 3) y seccion 5 (1,2,3,etc)) </span>
                                <input type="number" class="form-control form-control-sm" name="apartado"placeholder="Ejem. 1, 2, etc" >
                            </div>
                            <div class="form-group" id="imgseccion">
                                <label for="exampleInputEmail1">Insertar imagen</label>
                                <input type="file" class="form-control form-control-sm" name="imgseccion" accept=".jpg,.jpeg,.png"  >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fecha</label>
                                <input type="date" class="form-control form-control-sm" name="fecha" value="{{ date('Y-m-d') }}" required>
                            </div>
                            
                            	                 
                        </div>
                        @can('gp_seccion_crear')
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm float-sm-right"><i class="fa fa-save"></i> Guardar</button>
                        </div>
                        @endcan
                    </form>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card card-dark card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Listado de secciones</h3>
                    </div>
                    <div class="card-body">
                        {{-- @php
                        print_r($datos);
                        @endphp --}}
                        
                        
                        <table class="table table-bordered table-sm table-hover ">
                            <thead class="bg-secondary">
                                <tr><th>Id</th><th>Enlace</th><th>Seccion</th><th>Fecha creacion</th><th>Acciones</th></tr>
                            </thead>
                            <tbody>
                                @foreach($dato as $sec)
                                <tr><td>{{ $sec->idseccion }}</td><td>{{ $sec->texto_enlace }}</td><td>Seccion {{ $sec->seccion_pag }}</td><td>{{ $sec->created_at }}</td><td>
                                @if($sec->activo==1)
                                    <a href="/desactivaseccion/{{ $sec->idseccion }}"><i class="fa fa-toggle-on"></i></a>
                                    @else
                                    <a href="/activaseccion/{{ $sec->idseccion }}"><i class="fa fa-toggle-off"></i></a>
                                @endif
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                @can('gp_seccion_editar')<a href="#" class="btn btn-sm btn-default" title="Editar" onclick="cargar({{ $sec->idseccion }})" data-toggle="modal" data-target="#editseccion"><i class="fa fa-edit"></i></a>@endcan
                                @can('gp_seccion_eliminar')<a href="/elimnaseccion/{{ $sec->idseccion }}" class="btn btn-sm btn-default" title="Eliminar"><i class="fa fa-trash"></i></a>@endcan
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


{{-- modal editar seccion --}}
<div class="modal fade" id="editseccion">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar submenu</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form" method="post" action="{{ route('updregseccion') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="idseccion" id="idseccion1">
            <div class="card-body">	
                {{-- <div class="form-group">
                    <label>Secciona a cargar informacion</label> <a href="{{ asset('dist/img/seccion.png') }}" target="_blank"><i class="fa fa-question"></i> Ver ayuda</a>
                    <select class="form-control form-control-sm select2" style="width: 100%;" name="seccion" id="seccion" required>
                      <option value="">Seleccione la opcion</option>
                      <option value="1">Seccion 1</option>
                      <option value="2">Seccion 2</option>
                      <option value="3">Seccion 3</option>
                      <option value="4">Seccion 4</option>
                      <option value="5">Seccion 5</option>

                    </select>
                  </div>				 --}}
                <div class="form-group" id="tituloe">
                    <label for="exampleInputEmail1">Titulo/html</label>
                    {{-- <input type="text" class="form-control form-control-sm" name="titulo" placeholder="Ejem. Plataformas" > --}}
                    <textarea name="tituloe" id="tituloedit" cols="30" rows="2" class="textarea form-control form-control-sm"></textarea>
                </div>
                <div class="form-group" id="texto_enlacee">
                    <label for="exampleInputEmail1">Texto para el enlace</label>
                    <input type="text" class="form-control form-control-sm" name="texto_enlacee" id="texto_enlaceedit" placeholder="Ejem. Sistema de gestion digital" >
                </div>
                <div class="form-group" id="urle">
                    <label for="exampleInputEmail1">Url para el enlace</label>
                    <input type="text" class="form-control form-control-sm" name="Urle" id="Urledit" placeholder="Ejem. http://digtal.regionhuanuco.gob.pe" >
                </div>
                <div class="form-group" id="iconoe">
                    <label for="exampleInputEmail1">Icono para el enlace</label><span> <a href="https://adminlte.io/themes/AdminLTE/pages/UI/icons.html" target="_blank">Ver icono</a></span>
                    <input type="text" class="form-control form-control-sm" name="iconoe" id="iconoedit" placeholder="Ejem. fa fa-edit" >
                </div>
                <div class="form-group" id="colore">
                    <label for="exampleInputEmail1">Color para el enlace</label>
                    <select class="form-control form-control-sm " name="colore" id="coloredit">
                        <option selected="selected" value="primary">Primary</option>
                        <option value="success">Success</option>
                        <option value="warning">Warning</option>
                        <option value="danger">Danger</option>
                        <option value="info">Info</option>
                        <option value="secondary">Secondary</option>
                        <option value="dark">Dark</option>
                        <option value="gray">Gray</option>

                      </select>
                </div>
                <div class="form-group" id="apartadoe">
                    <label for="exampleInputEmail1">Apartado</label> <span class="text-success">(para seccion 2(1,2 y 3) y seccion 5 (1,2,3,etc)) </span>
                    <input type="number" class="form-control form-control-sm" name="apartadoe" id="apartadoedit" placeholder="Ejem. 1, 2, etc" >
                </div>
                <div class="form-group" id="imgseccione">
                    <label for="exampleInputEmail1">Insertar imagen</label>
                    <input type="file" class="form-control form-control-sm" name="imgseccione" accept=".jpg,.jpeg,.png"  >
                    <span>Nota: sino carga ninguna imagen se tomará la anterior imagen</span>
                </div>
                {{-- <div class="form-group">
                    <label for="exampleInputEmail1">Fecha</label>
                    <input type="date" class="form-control form-control-sm" name="fechae" value="{{ date('Y-m-d') }}" required>
                </div> --}}
                
                                     
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
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>

<script type="text/javascript">
 $('.textarea').summernote()
//Initialize Select2 Elements
$('.select2').select2()

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
    

$('#seccion').on('change', function()
    {
       if(this.value==1)
       {
        $("#titulo").hide();
        $("#texto_enlace").show();
        $("#url").show();
        $("#icono").show();
        $("#color").show();
        $("#apartado").hide();
        $("#imgseccion").hide();
       }
       if(this.value==2)
       {
        $("#titulo").show();
        $("#texto_enlace").show();
        $("#url").show();
        $("#icono").hide();
        $("#color").show();
        $("#apartado").show();
        $("#imgseccion").hide(); 
       }
       if(this.value==3)
       {
        $("#titulo").show();
        $("#texto_enlace").show();
        $("#url").show();
        $("#icono").hide();
        $("#color").show();
        $("#apartado").hide();
        $("#imgseccion").show(); 
       }
       if(this.value==4)
       {
        $("#titulo").show();
        $("#texto_enlace").show();
        $("#url").show();
        $("#icono").hide();
        $("#color").hide();
        $("#apartado").hide();
        $("#imgseccion").hide(); 
       }
       if(this.value==5)
       {
        $("#titulo").hide();
        $("#texto_enlace").show();
        $("#url").show();
        $("#icono").show();
        $("#color").show();
        $("#apartado").hide();
        $("#imgseccion").show(); 
       }
    });
</script>

<script type="text/javascript">
    @if(Session::has('desactivadoseccion'))
       toastr.success('{{ Session::get('desactivadoseccion') }}')
    @endif
    
    @if(Session::has('activadoseccion'))
       toastr.success('{{ Session::get('activadoseccion') }}')
    @endif  
    @if(Session::has('elimnaseccion'))
       toastr.error('{{ Session::get('elimnaseccion') }}')
    @endif 
    @if(Session::has('Actualizadosec'))
       toastr.info('{{ Session::get('Actualizadosec') }}')
    @endif
</script>

<script>
    function cargar(id)
    {
        $.ajax({
					url:'/editasecciones/'+id,// esto consulta a la reniec.
					type:'GET',
					dataType: "json",
					success:function(dato){

					//alert(dato[0].idseccion);

                    $("#idseccion1").val(dato[0].idseccion);

					if(dato[0].seccion_pag==1)
                        {
                            $("#tituloe").hide();
                            $("#texto_enlacee").show();
                            $("#urle").show();
                            $("#iconoe").show();
                            $("#colore").show();
                            $("#apartadoe").hide();
                            $("#imgseccione").hide();
                        }
                        if(dato[0].seccion_pag==2)
                        {
                            $("#tituloe").show();
                            $("#texto_enlacee").show();
                            $("#urle").show();
                            $("#iconoe").hide();
                            $("#colore").show();
                            $("#apartadoe").show();
                            $("#imgseccione").hide(); 
                        }
                        if(dato[0].seccion_pag==3)
                        {
                            $("#tituloe").show();
                            $("#texto_enlacee").show();
                            $("#urle").show();
                            $("#iconoe").hide();
                            $("#colore").show();
                            $("#apartadoe").hide();
                            $("#imgseccione").show(); 
                        }
                        if(dato[0].seccion_pag==4)
                        {
                            $("#tituloe").show();
                            $("#texto_enlacee").show();
                            $("#urle").show();
                            $("#iconoe").hide();
                            $("#colore").hide();
                            $("#apartadoe").hide();
                            $("#imgseccione").hide(); 
                        }
                        if(dato[0].seccion_pag==5)
                        {
                            $("#tituloe").hide();
                            $("#texto_enlacee").show();
                            $("#urle").show();
                            $("#iconoe").show();
                            $("#colore").show();
                            $("#apartadoe").hide();
                            $("#imgseccione").show(); 
                        }

                        $("#tituloedit").summernote("code",dato[0].titulo);
                        $("#texto_enlaceedit").val(dato[0].texto_enlace);
                        $("#Urledit").val(dato[0].enlace);

                        $("#iconoedit").val(dato[0].icono);
                        $("#coloredit").val(dato[0].color);
                        // $("#apartadoedit").val(dato[0].apartado);
                        
					
					
					}
					
				});
    }
</script>
@endsection
