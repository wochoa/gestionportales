@extends('plantillas.admin')
@section('titulopagina')
	Portalweb | Nueva publicación
@endsection
@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Sección de página
      <small class="text-secondary">Crear página nueva</small>
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item"><a href="{{ route('modulopagina') }}">Página</a></li>
      <li class="breadcrumb-item active">Crear</li>
    </ol>
  </div>
@endsection

@section('contenido')
<div class="container-fluid">
<div class="row p-2">
	<a href="{{ route('modulopagina') }}" class="btn btn-sm btn-success">Ver paginas creadas</a>
</div>
<form  method="post" action="{{route('formnewpagina')}}" accept-charset="UTF-8" enctype="multipart/form-data">
	@csrf
{{-- <input type="hidden" name="idweb" value="{{ Auth::user()->iddirecciones_web }}"> --}}
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
	                      <input type="text" class="form-control" name="nompagina" placeholder="Ingrese el título de su publicación" required>
	                    </div>
	                 </div>
	                 {{-- <div class="form-group row">
	                 	<label for="inputEmail3" class="col-sm-2 col-form-label">Imagenes</label>
	                 	<div class="custom-file col-sm-3">
	                      <input type="file" class="custom-file-input" name="imagen1" accept=".jpg,.jpeg,.png"  required>
	                      <label class="custom-file-label" for="customFile">Seleccione Imagen 1</label>
	                    </div>
	                    <div class="custom-file col-sm-3">
	                      <input type="file" class="custom-file-input" name="imagen2" accept=".jpg,.jpeg,.png" >
	                      <label class="custom-file-label" for="customFile">Seleccione Imagen 2</label>
	                    </div>
	                    <div class="custom-file col-sm-3">
	                      <input type="file" class="custom-file-input" name="imagen3" accept=".jpg,.jpeg,.png" >
	                      <label class="custom-file-label" for="customFile">Seleccione Imagen 3</label>
	                    </div>
	                 </div> --}}
	                 <div class="form-group row">
	                 	<label class="col-sm-2 col-form-label">Contenido de publicación</label>
	                 	<div class="col-sm-12">
		                	<textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required name="contenido"></textarea>
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
	                    <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required name="fecha" value="{{ date('d/m/Y') }}">
	                  </div>
	                  <!-- /.input group -->
	                </div>
					{{-- <div class="form-group">
                        <label>Categoria</label>
                        <select class="custom-select" required name="categoria">
                          <option value="">Selecciona una categoria</option>
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option>
                        </select>
                    </div>
                    <div class="form-group">
	                  <label>Etiquetas</label>
	                  <select class="select2" multiple="multiple" data-placeholder="Selecciona una o mas etiquetas" style="width: 100%;" required name="etiquetas">
	                    <option>Alabama</option>
	                    <option>Alaska</option>
	                    <option>California</option>
	                    <option>Delaware</option>
	                    <option>Tennessee</option>
	                    <option>Texas</option>
	                    <option>Washington</option>
	                  </select>
	                </div> --}}
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
    $('.textarea').summernote()
  })

//Initialize Select2 Elements
    $('.select2').select2();
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    $('[data-mask]').inputmask()
    bsCustomFileInput.init();
</script>
<script type="text/javascript">
	@if(Session::has('nuevapagina'))
       toastr.success('{{ Session::get('nuevapagina') }}')
    @endif
</script>

@endsection