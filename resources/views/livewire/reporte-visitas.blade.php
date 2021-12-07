<div>
    <div class="row">
        <div class="col-sm-4 p-1">
            <div class="input-group">
                <input type="search" class="form-control form-control-sm" placeholder="Digite la busqueda por DNI" wire:model="search" onkeyup="javascript:this.value=this.value.toUpperCase();">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card pl-3">
                <form action="{{ route('reportevisitas') }}" method="post">
                    <div class="form-group row">
                        @csrf
                        <div class="col-md-3">
                        <label for="">Fecha inicial</label>
                        <input type="date" name="fecha1" class="form-control form-control-sm"> 
                        @error('fecha1')
                            <small class="text-danger">{{ $message }}</small>  
                        @enderror                     
                        </div>
                        <div class="col-md-3">
                        <label for="">Fecha inicial</label>
                        <input type="date" name="fecha2"  class="form-control form-control-sm">
                        @error('fecha2')
                            <small class="text-danger">{{ $message }}</small>  
                        @enderror
                        </div>
                        <div class="col-md-3 mt-4 mb-2">
                        <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-file-pdf"></i> Descargar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    
    </div>
    <div class="row">
        
        <div class="col-sm-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Listado de Vistas</h3>
                 </div> <!-- /.card-body -->
                <div class="card-body">
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr><th>ID</th><th>DNI</th><th>NOMBRE</th><th>FECHA INGRESO</th><th>OFICINA</th><th>FECHA SALIDA</th><th>ASUNTO</th></tr>
                        </thead>
                        <tbody>
                            @forelse($regvisita as $key)
                                <tr>
                                    <td>{{ $key->idregvisita }}</td>
                                    <td>{{ $key->dni }}</td>
                                    <td>{{ $key->nombre }}</td>
                                    <td>{{ $key->fechaingreso }}</td>
                                    <td>{{ $key->nom_oficina }}</td>
                                    <td>{{ $key->fechasalida }}</td>
                                    <td>{{ $key->motivo }}</td>
                                </tr>
                            @empty
                                
                            @endforelse
                        </tbody>
                    </table>
                    {{-- @php
                        print_r($datospag);
                    @endphp --}}
                </div>
                <div class="card-footer clearfix">
                   {{ $regvisita->links() }} 
                </div>
            </div>
        </div>
        {{-- <div class="col-sm-3">
            <div class="card card-dark card-outline">
                <div class="card-body">
                    sss
                </div>
            </div>
        </div> --}}
    
    
    </div>
</div>