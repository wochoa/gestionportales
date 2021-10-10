@extends('plantillas.admin')
@section('titulopagina')
	Admin|Dashboard
@endsection

@section('contenido')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3">
      <div class="card">
        <div class="card-body">
          <p>Bienvenido, {{ Auth::user()->adm_name }} {{ Auth::user()->adm_lastname }}</p>
          <p>Usted administra portal web de: <strong class="text-danger">{{ $nombreportalweb }}</strong></p>
          <p>Su rol es:
            @forelse($colroles as $clrol)
              @if($clrol->role_id>=5 and $clrol->role_id<=9)
                <span class="text-danger"> {{ $clrol->name }}</span>
              @endif
            @empty
              Notiene ningún rol para esta página
            @endforelse
          </p>
          <div class="alert bg-secondary">
            Si desea cambiar de rol comuníquese con el administrador de sistemas
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-9">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-3">
              <div class="small-box bg-info">
                <div class="inner">
                  @php
                      $total=count($dirweb)+count($dirweb2);
                  @endphp
                  <h3>{{ $total }} </h3>{{-- Registrados --}}
          
                  <p><span class="badge badge-warning right">{{ count($dirweb) }}</span> Portales creadas 
                    {{-- <span class="badge badge-warning right">{{ count($dirweb2) }}</span>  web propio --}}
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                {{-- <a href="{{ route('registropagina') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>53<sup style="font-size: 20px">%</sup></h3>
        
                      <p>publicaciones realizadas</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                    {{-- <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a> --}}
                  </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ count($usuarios) }}</h3>
        
                  <p>Usuarios Registrados</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                {{-- <a href="{{ route('registrousuarios') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a> --}}
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>65</h3>
        
                  <p>Registro de visitas</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a> --}}
              </div>
            </div>
            <!-- ./col -->
          </div>
        </div>
      </div>
    </div>
	</div>
</div>
	
@endsection