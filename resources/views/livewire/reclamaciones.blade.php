<div>{{-- inicio div livewire --}}
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <div class="row">
	
		<div class="col-sm-12">
			<div class="card card-primary card-outline">
				<div class="card-header">
		            <h3 class="card-title">Listado de reclamaciones</h3>
		         </div> <!-- /.card-body -->
				<div class="card-body">
					<table class="table table-hover table-sm table-bordered">
						{{-- <thead>
							<tr><th>Cod</th><th>DNI</th><th>NOMBRE</th><th>FECHA INGRESO</th><th>OFICINA</th><th>FECHA SALIDA</th><th>ASUNTO</th></tr>
						</thead> --}}
						<tbody>
							@forelse($reclamaciones as $key)
								<tr>
									<td><small><strong>cod:</strong>{{ $key->lib_id }}<br>
                                        <strong>Ciudadano:</strong>{{ $key->lib_nombresapellidos }}<br>
                                        <strong>Telefono:</strong>{{ $key->lib_telefono }}<br>
                                        <strong>Correo:</strong>{{ $key->lib_email }}<br>
                                        <strong>Enviado:</strong> {{ $key->lib_fecha }}</small></td>

									<td><small><strong>Texto enviado:</strong><br>{{ $key->lib_descripcion }}</small></td>
									<td nowrap><button class="btn btn-primary btn-xs"><i class="fas fa-envelope-square"></i></button>
                                        <button class="btn btn-danger btn-xs"><i class="fas fa-at"></i></button></td>
								</tr>
							@empty
								
							@endforelse
						</tbody>
                    </table>
                    {{-- @php
                        print_r($datospag);
                    @endphp --}}
				</div>
				{{-- <div class="card-footer clearfix">
	               {{ $regvisita->links() }} 
	            </div> --}}
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

</div>{{-- Fin div livewire --}}

@section('script')
<script type="text/javascript">
	$("ul.pagination").addClass('pagination-sm m-0 float-right');

	@if(Session::has('eliminadopag'))
		toastr.error('{{ Session::get('eliminadopag') }}')
	@endif
</script>
@endsection