@extends('plantillas.admin')
@section('titulopagina')
	Admin|Dashboard
@endsection

@section('contenido')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3">
			<div class="small-box bg-info">
				<div class="inner">
          @php
              $total=count($dirweb)+count($dirweb2);
          @endphp
				  <h3>{{ $total }} Registrados</h3>
  
          <p><span class="badge badge-warning right">{{ count($dirweb) }}</span> Páginas creadas 
            <span class="badge badge-warning right">{{ count($dirweb2) }}</span>  web propio</p>
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
	
@endsection