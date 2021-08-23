<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-5">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Datos de visitante</h3>
                    </div> <!-- /.card-body -->
                    <div class="card-body">					
                        <div class="form-group row">
                            <label for="exampleInputEmail1" class="col-sm-4">Numero documento:</label>
                            <div class="col-sm-4"><input type="number" class="form-control form-control-sm" name="dni" id="ndocu" placeholder="Número Documento" required wire:model="ndni" autofocus>
                                @error('ndni')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            {{-- <div class="col-sm-4"><button class="btn btn-xs btn-success" wire:click="buscardni">Buscar y ver foto</button></div> --}}
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail1" class="col-sm-4">Nombres y apellidos:</label>
                            <div class="col-sm-8"><input type="text" class="form-control form-control-sm" name="nombre" id="nombre" placeholder="Nombres y apellidos" required wire:model="nombres">
                                @error('nombres')<small class="text-danger">{{ $message }}</small>@enderror</div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail1" class="col-sm-4">Institucion de procedencia:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="institucion" placeholder="Ejemp. Poder Judicial" value="PERSONA NATURAL" wire:model="iprocedencia">
                                @error('iprocedencia')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                                                
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div id="foto">{!! $foto !!}</div>
            </div>
            <div class="col-sm-5">
                <div class="card card-dark card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Oficina a visitar</h3>
                    </div>
                    <div class="card-body">
                       <div class="form-group row">
                         <label for="" class="col-sm-4">OFICINA</label>
                         <div class="col-sm-8">
                             <select class="form-control select2" wire:click="busofifuncionario($event.target.value)" required>
                                 @if($codoficina==0)
                                 <option selected value="0">Selecione la oficina...</option>
                                 @endif
                               
                                @foreach($unidadorganica as $key)
                                    @if($key->iddependencia==$codoficina)
                                    <option value="{{ $key->iddependencia }}" selected>{{ $key->depe_nombre }}</option>
                                    @else
                                    <option value="{{ $key->iddependencia }}">{{ $key->depe_nombre }}</option>
                                    @endif
                                    
                                @endforeach
                             </select>
                             @error('codoficina')<small class="text-danger">{{ $message }}</small>@enderror
                             {{ $nomfuncionario }}
                         </div>
                        </div> 
                        <div class="form-group row">
                                <label for="" class="col-sm-4">Motivo de visita</label>
                                <div class="col-sm-8">
                                    <select class="form-control form-control-sm" wire:model="motivo">
                                        <option selected>Selecione la opcion...</option>
                                        <option value="Tramite documentario">Tramite documentario</option>
                                        <option value="Reunión">Reunión</option>
                                        <option value="Motivo Institucional">Motivo Institucional</option>
                                        <option value="Motivo personal">Motivo personal</option>
                                        <option value="Otros">Otros</option>
                                    </select>
                                    @error('motivo')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                        </div>
                        
                        
                    </div>
                    <div class="card-footer justify-content-between p-1">
                        <button class="btn btn-primary btn-xs" wire:click="registravisita">Registrar visita</button>
                    </div>
                </div>
            </div>
                 
            
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="search" class="form-control form-control-sm" placeholder="Digite la busqueda" wire:model="search" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group row float-right">
                                    <label for="" class="col-sm-4">Ingresar DNI para salir</label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control form-control-sm" wire:model="dnisalida">
                                        @error('dnisalida')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="col-sm-4">
                                        <button class="btn btn-xs btn-danger" wire:click="Regsalida">Registrar salida</button>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <table class="table table-border table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th>DNI</th>
                                    <th>NOMBRE</th>
                                    <th>FECHA INGRESO</th>
                                    <th>OFICINA</th>
                                    <th>ESTADO</th>
                                    <th>ASUNTO</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($regvisita as $key)
                                   <tr>
                                       <td>{{ $key->idregvisita }}</td>
                                       <td>{{ $key->dni }}</td>
                                       <td>{{ $key->nombre }}</td>
                                       <td>{{ $key->fechaingreso }}</td>
                                       <td>{{ $key->nom_oficina }}</td>
                                       <td>INGRESADO</td>
                                       <td>{{ $key->motivo }}</td>
                                    </tr> 
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer float right">
                        {{ $regvisita->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
     

    

</div>

@section('script')
    
<script type="text/javascript">
//Initialize Select2 Elements
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
});
    // $('input[type=radio][name=tieneweb]').change(function() {
 //    if (this.value== 'SI') {$('#dominiogore').show();$('#dominioext').hide();}
 //    else{$('#dominioext').show();$('#dominiogore').hide();}
    // });
    $("ul.pagination").addClass('pagination-sm m-0 float-right');

</script>

<script type="text/javascript">
    // @if(Session::has('success'))
    //    toastr.success('{{ Session::get('success') }}')
    // @endif
    


    window.livewire.on('regvisita', () => {
        //$('#atender').modal('hide');
        toastr.success('Fue registrado la visita')

    });

    window.livewire.on('dninoexiste', () => {
        //$('#atender').modal('hide');
        toastr.error('El dni digitado no Ingresó')

    });

    window.livewire.on('dnisalida', () => {
        //$('#atender').modal('hide');
        toastr.info('Fue registrado la salida')

    });

    



</script>
<script>
    $("#ndocu").keyup(function() {//keypress -> cuando digita en el formulario anterior 
           var user_id = $('#ndocu').val();// VALOR DEL INPUT
           var cantcaracter=$('#ndocu').val().length;

           // pasos a considerar:
           // 1. se tiene que consultar a nuestro base de datos existentes
           // 2. si no datos en nuestra data, entonces recien consultamos e la reniec.
           if(cantcaracter==8)// cantidad de numeros de DNI
           {
            $.ajax({type:'GET',
                                    url:'{{ url('reniec') }}/'+user_id,// esto consulta a la reniec.
                                    dataType: "json",
                                    data:{cdni:user_id},
                                  //data:{dni:user_id},
                                     success:function(data){
                                    //console.log(data);
                                        //$('#ndocu').val();
                                    //  $('#nombre').val(data.prenombres + ' ' + data.apPrimer + ' ' + data.apSegundo);
                                    //  $('#foto').html('<img src="data:image/jpg;base64,'+ data.foto+'">');                                 
                                    //  $("#ndocu" ).focus();
                                     Livewire.emit('Iniciavadni',data)
                                    }
                                  
                              });
           }

      
    });
</script>
@endsection
