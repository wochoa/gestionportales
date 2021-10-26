@extends('plantillas.admin')

@section('titulopagina')
	Portalweb | categoria
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Registro de categorias
      <small></small>
    </h1>
  </div>
  <div class="col-sm-6">
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
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Nueva nueva categira para publicaciones</h3>
                    </div> <!-- /.card-body -->
                    <form class="form" method="post" action="{{ route('addregcategoria') }}">
                        @csrf
                        {{-- <input type="hidden" name="iddirweb"  value="{{ Auth::user()->iddirecciones_web }}"> --}}
                        <div class="card-body">					
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre de la categoria</label>
                                <input type="text" class="form-control" name="nomdireccion" placeholder="Ejem. publicacion, insttitucional" required>
                            </div>
                            	                 
                        </div>
                        @can('gp_categoria_crear')
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm float-sm-right"><i class="fa fa-save"></i> Guardar</button>
                        </div>
                        @endcan
                    </form>
                </div>
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
                                <td><button class="btn btn-primary btn-xs" onclick="cargararchivos({{ $cas->id_proc_sel_cas }})"><i class="fa fa-eye"></i></button></td>
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

<div class="modal fade" id="agergararchivos">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar item</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route("forarchivoscas") }}" method="POST">
            @csrf
            <div class="modal-body">
                <input type="text" id="idproceso" name="idproceso">
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
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerra</button>
              <button type="submit" class="btn btn-primary">Agregar</button>
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
    @if(Session::has('success'))
       toastr.success('{{ Session::get('success') }}')
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
                tabla+='<thead><tr><th>ID</th><th>Nombre</th><th>URL</th><th>Proceso</th></tr></thead>'
            for(i=0;i<cantidad;i++)//i=0;i<dato;i++
            {
              tabla+="<tr><td>"+data[i].idarchivo_sel_cas+"</td><td><small>"+data[i].nom_archivo+"</small></td><td><small>"+data[i].url_archivo+"</small></td><td><small>"+data[i].etapa+"</small></td></tr>";
            

            }
            
            $('#resultado').html(tabla);
               
           }
       });
    }

    function identificadorarchivos(id)
    {
        $('#idproceso').val(id);
    }
</script>

@endsection
