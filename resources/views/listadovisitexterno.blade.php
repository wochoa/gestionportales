@extends('layouts.app')
@section('content')




<div class="container">

	

    <div class="row">
        
        <div class="col-sm-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Listado de Vistas: <strong>{{ utf8_encode($nombredireccion) }}</strong></h3>
                 </div> <!-- /.card-body -->
                
                    @livewire('vistaexterna', ['idweb' => $id])
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
@endsection



