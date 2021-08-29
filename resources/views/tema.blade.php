@extends('plantillas.admin')
@section('titulopagina')
	Portalweb | tema
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection
@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Registro de configuracion de tema
      <small></small>
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">configuracion de tema</li>
    </ol>
  </div>
@endsection

@section('contenido')
{{-- <div class="row p-2">
	<a href="newpublicaciones" class="btn btn-sm btn-primary">Crear publicación</a>
</div> --}}

<div class="container-fluid">
    <div class="row">
            @if(count($datos)<>1)
            <div class="col-sm-8">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Nueva configuracion de tema</h3>
                    </div> <!-- /.card-body -->
                    <form class="form" method="post" action="{{ route('addtema') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="iddirweb"  value="{{ Auth::user()->iddirecciones_web }}"> --}}
                        <div class="card-body">					
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nombre de tema</label>
                                        <input type="text" class="form-control" name="nomtema" placeholder="Ejem. tema oficial" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Color del tema header:</label>
                      
                                        <div class="input-group my-colorpicker2">
                                          <input type="text" class="form-control" value="#054a91" name="colortema">
                      
                                          <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-square"></i></span>
                                          </div>
                                        </div>
                                        <!-- /.input group -->
                                      </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Logo</label>
                                        <input type="file" class="form-control" name="logo" placeholder="Ejem. logo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Correo atencion</label>
                                        <input type="text" class="form-control" name="correoatencion" placeholder="Ejem. sistemas@regionhuanuco.gob.pe" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Telefono atencion</label>
                                        <input type="text" class="form-control" name="tel_atencion" placeholder="Ejem. +51 (062) 51-2124" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Enlace correo corporativo</label>
                                        <input type="text" class="form-control" name="correocoporativo" placeholder="Ejem. https://mail.regionhuanuco.gob.pe/" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Enlace trasparencia estandar</label>
                                        <input type="text" class="form-control" name="urltrasnpararencia" placeholder="Ejem. http://" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Link mesa de partes virtual</label>
                                        <input type="text" class="form-control" name="linkmesapartes" placeholder="Ejem. http://" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                   
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">footer direccion</label>
                                        <textarea name="foote_1"  cols="30" rows="3" class="form-control"><ul class="nav nav-pills flex-column "><li class="nav-item nav-link ">  <i class="fa fa-flag"></i> Calle Calicanto 145 - Amarilis-Huanuco<br>Como llegar <a href="https://www.google.com.pe/maps/place/Gobierno+Regional+Hu%C3%A1nuco/@-9.9326677,-76.2380318,17z/data=!3m1!4b1!4m5!3m4!1s0x91a7c2fcae5899ab:0xdb74b5c9e67b6366!8m2!3d-9.932673!4d-76.2358431" target="_blank" class="text-warning"><i class="fa fa-arrow-circle-right"></i></a></li><li class="nav-item nav-link " style="font-size: 14px"><i class="fa fa-envelope"></i> mesadepartesvirtual@regionhuanuco.gob.pe<br>Oficina de Secretaría general </li><li class="nav-item nav-link "><i class="fa fa-envelope"></i> sistemas@regionhuanuco.gob.pe<br><small>Sub Gerencia de Desarrollo Insitucional y sistemas</small></li><li class="nav-item nav-link "> <i class="fa fa-phone"></i> Central telefónica<br>  +51 (062) 51-2124  </li></ul></textarea></div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">footer reclamaciones</label>
                                        <textarea name="foote_2" cols="30" rows="3" class="form-control">Ley Nº 27444 DECRETO SUPREMO Nº 042-2011-PCM, es obligación de las Entidades del Sector Público de contar con un Libro de Reclamaciones</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">footer denuncias</label>
                                        <textarea name="foote_3"  cols="30" rows="3" class="form-control">De acuerdo a la resolución "Servicio de Atención de Denuncias" Resolución de Contraloría N° 443-2003-DG Jefe de la oficina del Órgano de Control Interno del Gobierno Regional de Huánuco: CPC.JOSÉ ANTONIO ARREDONDO CRISTOBAL</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">footer Redes sociales</label>
                                        <textarea name="foote_4"  cols="30" rows="3" class="form-control"><h4 class="titulonot_2 text-info">Redes sociales</h4><ul class="nav nav-pills flex-column "><li class="nav-item nav-link "> Mantengase informado en nuestras redes socilaes</li><li class="nav-item nav-link"><a class="btn  btn-primary" style="color:#fff" href="https://www.facebook.com/pages/Gobierno-Regional-de-Hu%C3%A1nuco/1574977352748158" target="_blank"><i class="fa fa-thumbs-up"></i><br> <h5>Facebook</h5></a><a class="btn btn-danger" style="color:#fff" href="https://www.youtube.com/channel/UCFCS1cmD-9iM6nqetz-qXoA" target="_blank"><i class="fa fa-video"></i><br> <h5>Youtube</h5></a><a class="btn btn-info" style="color:#fff" href="https://www.instagram.com/gorehco/" target="_blank"><i class="fab fa-instagram"></i><br> <h5>Instagram</h5></a></li><li class="nav-item nav-link"><a class="btn bg-lightblue " style="color:#fff" href="https://twitter.com/HuanucoGobierno" target="_blank"><i class="fab fa-twitter"></i><br> <h5>Twiter</h5></a></li></ul></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Link de pagina de facebook para detalle noticias</label>
                                        <input type="text" class="form-control" name="linkfacebook" placeholder="Ejem. http://" >
                                    </div>
                                </div>
                            </div>
                            	                 
                        </div>
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm float-sm-right"><i class="fa fa-save"></i> Guardar</button>
                        </div>
                    </form>
                </div>
            </div>  
            @endif
            
            <div class="col-sm-4">
                <div class="card card-dark card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Listado de categorias</h3>
                    </div>
                    <div class="card-body">
                        {{-- @php
                        print_r($datos);
                        @endphp --}}
                        
                        
                        <table class="table table-bordered table-sm table-hover ">
                            <thead class="bg-secondary">
                                <tr><th>Id</th><th>Nombre</th><th>Fecha creacion</th><th>Acciones</th></tr>
                            </thead>
                            <tbody>
                                @foreach($datos as $tm)
                                <tr><td>{{ $tm->id_tema }}</td><td>{{ $tm->nom_tema }}</td><td>{{ $tm->created_at }}</td><td><a href="#" data-toggle="modal" data-target="#editema"><i class="fa fa-edit"></i></a></td></tr>
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

<!-- Modal editar tema -->
@if(count($datos))
  <div class="modal fade" id="editema" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop='static'>
	<div class="modal-dialog modal-xl">
	  <div class="modal-content">
		<form action="{{ route('formedittema') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Editar tema</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
		  
			  @csrf
            <div class="row">
                <div class="col-sm-6">
                    <input type="hidden" name="idtema"  value="{{ $datos[0]->id_tema }}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre de tema</label>
                        <input type="text" class="form-control" name="nomtema" placeholder="Ejem. tema oficial" value="{{ $datos[0]->nom_tema }}" required>
                    </div>
                    <div class="form-group">
                        <label>Color del tema header:</label>
    
                        <div class="input-group my-colorpicker2">
                        <input type="text" class="form-control" value="{{ $datos[0]->color_tema }}" name="colortema">
    
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-square"></i></span>
                        </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Logo</label>
                        <input type="file" class="form-control" name="logo" placeholder="Ejem. logo" >
                        <img src="{{ asset(Storage::url($datos[0]->logo_tema)) }}" alt="" height="40">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">favicon</label>
                        <input type="file" class="form-control" name="favicon" placeholder="Ejem. logo max 45x45 px" >
                        <img src="{{ asset(Storage::url($datos[0]->favicon)) }}" alt="" height="40">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo atencion</label>
                        <input type="text" class="form-control" name="correoatencion" value="{{ $datos[0]->top_email }}" placeholder="Ejem. sistemas@regionhuanuco.gob.pe" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Telefono atencion</label>
                        <input type="text" class="form-control" name="tel_atencion" value="{{ $datos[0]->top_fono }}" placeholder="Ejem. +51 (062) 51-2124" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enlace correo corporativo</label>
                        <input type="text" class="form-control" name="correocoporativo" value="{{ $datos[0]->top_correocorp }}" placeholder="Ejem. https://mail.regionhuanuco.gob.pe/" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enlace trasparencia estandar</label>
                        <input type="text" class="form-control" name="urltrasnpararencia" value="{{ $datos[0]->top_transparencia }}" placeholder="Ejem. http://" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Link mesa de partes virtual</label>
                        <input type="text" class="form-control" name="linkmesapartes" value="{{ $datos[0]->top_mesapartesvirtual }}" placeholder="Ejem. http://" required>
                    </div>
                </div>
                <div class="col-sm-6">
                
                    <div class="form-group">
                        <label for="exampleInputEmail1">footer direccion</label>
                        <textarea name="foote_1"  cols="30" rows="3" class="form-control">{{ $datos[0]->footer_f1 }}</textarea></div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">footer reclamaciones</label>
                        <textarea name="foote_2" cols="30" rows="3" class="form-control">{{ $datos[0]->footer_f2}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">footer denuncias</label>
                        <textarea name="foote_3"  cols="30" rows="3" class="form-control">{{ $datos[0]->footer_f3 }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">footer Redes sociales</label>
                        <textarea name="foote_4"  cols="30" rows="3" class="form-control">{{ $datos[0]->redes_sociales}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Link de pagina de facebook para detalle noticias</label>
                        <input type="text" class="form-control" name="linkfacebook2" value="{{ $datos[0]->linkpag_facebook }}" placeholder="Ejem. http://" >
                    </div>
                    <hr>
                    <small class="bg-info">Los codigos html, podra editarlo en cualquier editor de codigo(sublime, block de notas, worpad)</small>
                </div>
            </div>
		  
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
		  <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
		</div>
		</form>
	  </div>
	</div>
  </div>
@endif
@endsection

@section('script')
<!-- bootstrap color picker -->
<script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>

<script type="text/javascript">
//color picker with addon
$('.my-colorpicker2').colorpicker()

$('.my-colorpicker2').on('colorpickerChange', function(event) {
  $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
});

	// $('input[type=radio][name=tieneweb]').change(function() {
 //    if (this.value== 'SI') {$('#dominiogore').show();$('#dominioext').hide();}
 //    else{$('#dominioext').show();$('#dominiogore').hide();}
	// });
	$("ul.pagination").addClass('pagination-sm m-0 float-right');

</script>

<script type="text/javascript">
    @if(Session::has('newtema'))
       toastr.success('{{ Session::get('newtema') }}')
    @endif 
    @if(Session::has('updtema'))
       toastr.info('{{ Session::get('updtema') }}')
    @endif

</script>

@endsection
