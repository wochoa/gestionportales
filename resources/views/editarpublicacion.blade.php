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
      <li class="breadcrumb-item"><a href="{{ url('publicacion') }}">Publicación</a></li>
      <li class="breadcrumb-item active">Crear</li>
    </ol>
  </div>
@endsection

@section('contenido')
<div class="container-fluid">
<div class="row p-2">
	<a href="{{ route('publicacion') }}" class="btn btn-sm btn-primary">Ver publicaciones creadas</a>
</div>
<form  method="post" action="{{route('formeditapublicaciones')}}" accept-charset="UTF-8" enctype="multipart/form-data">
	@csrf

	<input type="hidden" name="idnoticia" value="{{ $dato[0]->idnoticias }}">

<div class="row">

		<div class="col-sm-9">
			<div class="card card-primary card-outline">
				<div class="card-header">
		            <h3 class="card-title">Nueva publicación</h3>
		         </div> <!-- /.card-body -->
				<div class="card-body">
					<div class="form-group row">
	                    <label for="inputEmail3" class="col-sm-2 col-form-label">Título</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" name="publicacion" placeholder="Ingrese el título de su publicación" value="{!! $dato[0]->titulo !!}" required>
	                    </div>
	                 </div>
	                 <div class="form-group row">
	                 	<label for="inputEmail3" class="col-sm-2 col-form-label">Imagenes</label>
	                 	<div class="custom-file col-sm-3">
	                      <input type="file" class="custom-file-input" name="imagen1" accept=".jpg,.jpeg,.png"  >
						  <label class="custom-file-label" for="customFile">Seleccione Imagen 1</label>
						  @if($dato[0]->img1)
						  <a href="{{ asset(Storage::url($dato[0]->img1)) }}" target="_blank">Ver imagen 1</a>
						  <a  data-toggle="tooltip" data-placement="top" data-html="true" class="btn btn-info btn-sm" title="<img src='{{ asset(Storage::url($dato[0]->img1)) }}' /width=180>" >Ver imagen1</a>
						  @endif

	                    </div>
	                    <div class="custom-file col-sm-3">
	                      <input type="file" class="custom-file-input" name="imagen2" accept=".jpg,.jpeg,.png" >
						  <label class="custom-file-label" for="customFile">Seleccione Imagen 2</label>
						  @if($dato[0]->img2)
						  <a href="{{ asset(Storage::url($dato[0]->img2)) }}" target="_blank">Ver imagen 2</a>
						  <a  data-toggle="tooltip" data-placement="top" data-html="true" class="btn btn-info btn-sm" title="<img src='{{ asset(Storage::url($dato[0]->img2)) }}' /width=180>" >Ver imagen2</a>
						  @endif
	                    </div>
	                    <div class="custom-file col-sm-3">
	                      <input type="file" class="custom-file-input" name="imagen3" accept=".jpg,.jpeg,.png" >
						  <label class="custom-file-label" for="customFile">Seleccione Imagen 3</label>
						  @if($dato[0]->img3)
						  <a href="{{ asset(Storage::url($dato[0]->img3)) }}" target="_blank">Ver imagen 3</a>
						  <a  data-toggle="tooltip" data-placement="top" data-html="true" class="btn btn-info btn-sm" title="<img src='{{ asset(Storage::url($dato[0]->img3)) }}' /width=180>" >Ver imagen3</a>
						  @endif

	                    </div>
	                 </div>
	                 <div class="form-group row">
	                 	<label class="col-sm-2 col-form-label">Contenido de publicación</label>
	                 	<div class="col-sm-12">
		                	<textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required name="contenido">{!! $dato[0]->contenido !!}</textarea>
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
	                    <input type="text" class="form-control" data-inputmask-alias="datetime" required name="fecha" value="{{ date('d/m/Y',strtotime($dato[0]->fechapubli)) }}">
	                  </div>
	                  <!-- /.input group -->
	                </div>
					<div class="form-group">
                        <label>Categoria</label>
                        <select class="custom-select" required name="categoria">
                          <option value="">Selecciona una categoria</option>
                          @foreach ($categoria as $item)
						  <option value="{{ $item->idcategoria }}">{{ $item->nomcategoia }}</option>  
						  @endforeach
                        </select>
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