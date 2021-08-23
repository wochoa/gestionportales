@extends('plantillas.admin')
@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('titulopagina')
	SGD | Responsable de administrar dependencias
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Registro de administradores de dependencias
      <small></small>
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">roles</li>
    </ol>
  </div>
@endsection

@section('contenido')
{{-- <div class="row p-2">
	<a href="newpublicaciones" class="btn btn-sm btn-primary">Crear publicación</a>
</div> --}}

<div class="container-fluid">
    <div class="row">
        
            
            <div class="col-sm-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Relacion de usuarios con <small class="bg-warning">ROL DE ADMINISTRADOR DE DEPENDENCIA</small></h3>
                    </div> <!-- /.card-body -->
                   
                        
                        <div class="card-body" style="font-size: 13px">					
                            {{-- {{ print_r($datos) }} --}}
                            <table class="table table-sm table-bordered table-hover table-striped" id="example1">
                                <thead>
                                    <tr><th>codDepe</th><th>Dependencia mesa partes</th><th>codCodUser</th><th>Rol asignado/Cargo</th><th>celular/Correo</th><th>acciones</th></tr>
                                </thead>
                                <tbody>
                                    
                                   
                                    @foreach($datos as $key)
                                    <tr><td>{{ $key->depe_depende }}</td><td>{{ $key->depe_nombre }}</td><td>{{ $key->user_id}}</td><td>{{ $key->adm_name}} {{ $key->adm_lastname}},<br><strong>Cargo:</strong> {{ $key->adm_cargo}}</td><td><strong>Telefono: </strong>{{ $key->adm_telefono}},<br><strong>Email: </strong> {{ $key->adm_correo}}</td><td>...</td></tr>
                                    @endforeach
                           
                                </tbody>
                            </table>	                 
                        </div>
                        <div class="card-footer">
                        
                        </div>
                    
                </div>
            </div>
        
    </div>
</div>



@endsection

@section('script')
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>



<script type="text/javascript">
    @if(Session::has('success'))
       toastr.success('{{ Session::get('success') }}')
    @endif

    $(function () {
    $("#example1").DataTable({
        "paging": true,
        "lengthMenu":		[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
			"iDisplayLength":	150,
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });


</script>

@endsection
