@extends('plantillas.admin')

@section('titulopagina')
	Portalweb | categoria
@endsection

@section('titulosuperior')
<div class="col-sm-8">
    <h1>
      Registro de Convocatorias
      <small>(Enlace para compartir: <span>{{ $dnweb }}/convocatorias</span> )</small>
    </h1>
  </div>
  <div class="col-sm-4">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">categorias</li>
    </ol>
  </div>
@endsection

@section('contenido')
{{-- <div class="row p-2">
	<a href="newpublicaciones" class="btn btn-sm btn-primary">Crear publicación</a>
</div> --}}

<div class="container-fluid">
    <div class="row">
        
            <div class="col-sm-5">
                <button class="btn btn-xs btn-primary mb-3" data-toggle="modal" data-target="#nuevoproceso">Nuevo proceso</button>
                <div class="card">
                    <table class="table table-borderd table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Proceso</th>
                                <th>Ins ini</th>
                                <th>Ins fin</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($procesocas as $cas)
                            <tr>
                                <td>{{ utf8_encode($cas->id_proc_sel_cas )}}</td>
                                <td>{{ utf8_encode($cas->proc_sel_cas_descripcion )}}</td>
                                <td>{{ $cas->proc_sel_cas_fecha_inicio }}</td>
                                <td>{{ $cas->cas_proc_sel_fecha_fin_inscripcion }}</td>
                                <td nowrap><button class="btn btn-primary btn-xs" onclick="cargararchivos({{ $cas->id_proc_sel_cas }})"><i class="fa fa-eye"></i></button>
                                    <button class="btn btn-primary btn-xs" onclick="editar({{ $cas->id_proc_sel_cas }})" data-toggle="modal" data-target="#editaprocesocas"><i class="fa fa-edit"></i></button></td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                    <div class="card-footer">
                        {{ $procesocas->links() }}
                    </div>
                    
                </div>
            </div>
            <div class="col-sm-7">
                <div class="card card-dark card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Listado de categorias</h3>
                    </div>
                    <div class="card-body">
                        <div id="resultado">

                        </div>
                        
                    </div>
                    <div class="card-footer clearfix">
                    {{-- {{ $datos->links() }} --}}
                </div>
                </div>
                
            </div>
        
        
    </div>
</div>
<div class="modal fade" id="nuevoproceso">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo proceso cas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" method="post" action="{{ route('addregprocesocas') }}">
                @csrf
                {{-- <input type="hidden" name="iddirweb"  value="{{ Auth::user()->iddirecciones_web }}"> --}}
                <div class="modal-body">					
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre del proceso</label>
                        <input autofocus type="text" class="form-control form-control-sm" name="nomproceso" placeholder="Ejem. PROCESO CAS..." required >
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="">Inicio inscripcion</label>
                            <input type="date" name="inicioinscripcion"  class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-6">
                            <label for="">Fin inscripcion</label>
                            <input type="date" name="fininscripcion" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fecha resultados</label>
                        <input type="date" class="form-control form-control-sm" name="fecharesultado" placeholder="Ejem. PROCESO CAS..." required>
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
</div>
<div class="modal fade" id="editaprocesocas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar proceso cas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" method="post" action="{{ route('updateprocesocas') }}">
                @csrf
                {{-- <input type="hidden" name="iddirweb"  value="{{ Auth::user()->iddirecciones_web }}"> --}}
                <input type="hidden" id="idprocess" name="ipprocess">
                <div class="modal-body">					
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre del proceso</label>
                        <input autofocus type="text" class="form-control form-control-sm" name="nomprocesos" id="nomprocesos" placeholder="Ejem. PROCESO CAS..." required >
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="">Inicio inscripcion</label>
                            <input type="date" name="inicioinscripcions" id="inicioinscripcions"  class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-6">
                            <label for="">Fin inscripcion</label>
                            <input type="date" name="fininscripcions" id="fininscripcions" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fecha resultados</label>
                        <input type="date" class="form-control form-control-sm" name="fecharesultados" id="fecharesultados" placeholder="Ejem. PROCESO CAS..." required>
                    </div>
                                         
                </div>
                @can('gp_categoria_crear')
                <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm float-sm-right"><i class="fa fa-save"></i> Actualizar</button>
                </div>
                @endcan
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="agergararchivos">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar item al proceso</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route("forarchivoscas") }}" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" id="idproceso" name="idproceso">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control form-control-sm" name="archivo" required>
                </div>
                
                <div class="form-group">
                    <label for="">URL</label>
                    <input type="text" class="form-control form-control-sm" name="url" required>
                </div>
                <div class="form-group">
                    <label for="">Etapa</label>
                    <select name="etapa" class="form-control form-control-sm" required>
                        <option value="INSCRIPCION">INSCRIPCION</option>
                        <option value="CURRICULAR">CURRICULAR</option>
                        <option value="ENTREVISTA">ENTREVISTA</option>
                        <option value="FINAL">FINAL</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="editararchivos">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar item al proceso</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route("frmeditararchivoproceso") }}" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" id="idarchivoproc" name="idarchivoproc">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control form-control-sm" name="archivoedits" id="archivoedits" required>
                </div>
                
                <div class="form-group">
                    <label for="">URL</label>
                    <input type="text" class="form-control form-control-sm" name="urls" id="urls" required>
                </div>
                <div class="form-group">
                    <label for="">Etapa</label>
                    <select name="etapas" class="form-control form-control-sm" id="etapas" required>
                        <option value="INSCRIPCION">INSCRIPCION</option>
                        <option value="CURRICULAR">CURRICULAR</option>
                        <option value="ENTREVISTA">ENTREVISTA</option>
                        <option value="FINAL">FINAL</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

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
    @if(Session::has('newitemproceso'))
       toastr.success('{{ Session::get('newitemproceso') }}')
    @endif
    @if(Session::has('newproceso'))
       toastr.success('{{ Session::get('newproceso') }}')
    @endif //
    @if(Session::has('procesoeditado'))
       toastr.info('{{ Session::get('procesoeditado') }}')
    @endif //

    @if(Session::has('archivoeliminado'))
       toastr.error('{{ Session::get('archivoeliminado') }}')
    @endif//
    @if(Session::has('archivoselcas'))
       toastr.info('{{ Session::get('archivoselcas') }}')
    @endif 

    function cargararchivos(id)
    {
        $.ajax({
            type: "GET",
            url: '/verarchivoscas/'+id,
            data: $(this).serialize(),
            success: function(data)
            {
                //var jsonData = JSON.parse(response);

                cantidad=data.length;
                boton='<button class="btn btn-success btn-xs" onclick="identificadorarchivos('+id+')" data-toggle="modal" data-target="#agergararchivos" mb-2>Agregar archivos al proceso</button>';
                tabla=boton+'<table class="table table-bordered table-sm table-responsive ">';
                tabla+='<thead><tr><th>ID</th><th>Nombre</th><th>URL</th><th>Proceso</th><th></th></tr></thead>'
            for(i=0;i<cantidad;i++)//i=0;i<dato;i++
            {
              tabla+="<tr><td>"+data[i].idarchivo_sel_cas+"</td><td><small>"+data[i].nom_archivo+"</small></td><td><small>"+data[i].url_archivo+"</small></td><td><small>"+data[i].etapa+"</small></td><td nowrap><button class='btn btn-success btn-xs' onclick='editaitem("+data[i].idarchivo_sel_cas+")' data-toggle='modal' data-target='#editararchivos'><i class='fa fa-edit'></i></button> <a class='btn btn-danger btn-xs' href='/eliminaritemproceso/"+data[i].idarchivo_sel_cas+"' ><i class='fa fa-trash'></i></a></td></tr>";
            

            }
            
            $('#resultado').html(tabla);
               
           }
       });
    }
    function editar(id){
        $.ajax({
            type: "GET",
            url: '/verprocesocas/'+id,
            data: $(this).serialize(),
            success: function(data)
            {
                //var jsonData = JSON.parse(response);
             $("#idprocess").val(data[0].id_proc_sel_cas);
             $("#nomprocesos").val(data[0].proc_sel_cas_descripcion);
             $("#inicioinscripcions").val(data[0].proc_sel_cas_fecha_inicio);
             $("#fininscripcions").val(data[0].cas_proc_sel_fecha_fin_inscripcion);
             $("#fecharesultados").val(data[0].cas_proc_sel_fecha_resultados);//
               
           }
       });
    }

    function editaitem(id)
    {
        $.ajax({
            type: "GET",
            url: '/verarchivoitemproceso/'+id,
            data: $(this).serialize(),
            success: function(data)
            {
                //var jsonData = JSON.parse(response);
             $("#idarchivoproc").val(data[0].idarchivo_sel_cas);
             $("#archivoedits").val(data[0].nom_archivo);
             $("#urls").val(data[0].url_archivo);
             $("#etapas").val(data[0].etapa);

               
           }
       });
    }

    function identificadorarchivos(id)
    {
        $('#idproceso').val(id);
    }
</script>

@endsection
