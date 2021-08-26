@extends('plantillas.admin')

@section('titulopagina')
	publicación | Editar
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Publicación
      <small class="text-secondary">Crear nuevo</small>
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item"><a href="{{ url('modulopagina') }}">Páginas</a></li>
      <li class="breadcrumb-item active">Crear</li>
    </ol>
  </div>
@endsection

@section('contenido')
<div class="container-fluid">
<div class="row p-2">
    <a href="{{ route('modulopagina') }}" class="btn btn-sm btn-primary">Ver páginas creadas</a>&nbsp;&nbsp; 
    @can('gp_pagina_crear')<a href="{{ route('newpagina') }}" class="btn btn-sm btn-primary">Crear nuevo</a>@endcan
</div>
<form  method="post" action="{{route('updatepagina')}}" accept-charset="UTF-8" enctype="multipart/form-data">
	@csrf

	<input type="hidden" name="idpagina" value="{{ $dato[0]->id_pagina }}">

<div class="row">

		<div class="col-sm-9">
			<div class="card card-primary card-outline">
				<div class="card-header">
		            <h3 class="card-title">Nueva Página</h3>
		         </div> <!-- /.card-body -->
				<div class="card-body">
					<div class="form-group row">
	                    <label for="inputEmail3" class="col-sm-2 col-form-label">Título</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" name="publicacion" placeholder="Ingrese el título de su publicación" value="{!! $dato[0]->nom_pagina !!}" required>
	                    </div>
	                 </div>
	                 
	                 <div class="form-group row">
	                 	<label class="col-sm-6 col-form-label">Contenido de publicación</label>
	                 	<div class="col-sm-12">
		                	<textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required name="contenido">{!! $dato[0]->cont_pagina  !!}</textarea>
		                </div>
					 </div>

				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card card-dark card-outline">
				<div class="card-body">
					<div class="form-group">
	                  <label>Fecha de publicación:</label>

	                  <div class="input-group">
	                    <div class="input-group-prepend">
	                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
	                    </div>
	                    <input type="text" class="form-control" data-inputmask-alias="datetime" required name="fecha" value="{{ date('d/m/Y',strtotime($dato[0]->fecha_pag)) }}">
	                  </div>
	                  <!-- /.input group -->
	                </div>
					
					<button type="submit" class="btn btn-primary btn-block mb-3">Guardar publicación</button>
				</div>
			</div>
		</div>


</div>

</form>
</div>

@endsection

@section('script')
<!-- bs-custom-file-input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script type="text/javascript">

	  $(function () {
    // Summernote
	$('.textarea').summernote();
	$('[data-toggle="tooltip"]').tooltip();
  })

//Initialize Select2 Elements
    $('.select2').select2();
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    $('[data-mask]').inputmask()
    bsCustomFileInput.init();
</script>
{{-- <script type="text/javascript">
	function validateFileType(){
     var fileName = document.getElementById("fileName").value;
     var idxDot = fileName.lastIndexOf(".") + 1;
     var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
     if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
      //TO DO
     }else{
      alert("Only jpg/jpeg and png files are allowed!");
     }
    }
</script> --}}
<script type="text/javascript">
	 @if(Session::has('success'))
        toastr.success('{{ Session::get('success') }}')
 @endif

</script>

@endsection