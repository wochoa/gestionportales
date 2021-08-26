@extends('plantillas.admin')
@section('titulopagina')
	Portalweb | Ver publicación
@endsection
@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Publicación
      <small class="text-secondary">ver</small>
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item"><a href="{{ url('publicacion') }}">Módulo página</a></li>
      <li class="breadcrumb-item active">Ver</li>
    </ol>
  </div>
@endsection

@section('contenido')
<div class="container">

    <div class="row p-2">
      <a href="{{ route('modulopagina') }}" class="btn btn-sm btn-primary">Ver módulo página creadas</a>&nbsp;&nbsp; @can('gp_pagina_crear')<a href="{{ route('newpagina') }}" class="btn btn-sm btn-info">Crear página</a>@endcan
    </div>
    <form  method="post" action="{{route('formnewpublicaciones')}}" accept-charset="UTF-8" enctype="multipart/form-data">
      @csrf

    <div class="row">

        <div class="col-sm-9">
          @php
          //print_r($dato);
          @endphp
          <h4>{{ utf8_encode($dato[0]->nom_pagina) }}</h4>
          

          <div class="row">
            {!! html_entity_decode(utf8_encode($dato[0]->cont_pagina)) !!}
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

@endsection