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
      <li class="breadcrumb-item"><a href="{{ url('publicacion') }}">Publicación</a></li>
      <li class="breadcrumb-item active">Ver</li>
    </ol>
  </div>
@endsection

@section('contenido')
<div class="container">

    <div class="row p-2">
      <a href="{{ route('publicacion') }}" class="btn btn-sm btn-primary">Ver publicaciones creadas</a>&nbsp;&nbsp; <a href="{{ route('newpublicaciones') }}" class="btn btn-sm btn-info">Crear publicación</a>
    </div>
    <form  method="post" action="{{route('formnewpublicaciones')}}" accept-charset="UTF-8" enctype="multipart/form-data">
      @csrf

    <div class="row">

        <div class="col-sm-9">
          @php
          //print_r($dato);
          @endphp
          <h4>{{ $dato[0]->titulo }}</h4>
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              @if($dato[0]->img1)
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              @endif
              @if($dato[0]->img2)
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              @endif
              @if($dato[0]->img3)
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              @endif
            </ol>
            <div class="carousel-inner">
              @if($dato[0]->img1)
              <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset(Storage::url($dato[0]->img1)) }}" alt="First slide">
              </div>
              @endif
              @if($dato[0]->img2)
              <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset(Storage::url($dato[0]->img2)) }}" alt="Second slide">
              </div>
              @endif
              @if($dato[0]->img3)
              <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset(Storage::url($dato[0]->img3)) }}" alt="Third slide">
              </div>
              @endif
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <div class="row">
            {!! $dato[0]->contenido !!}
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