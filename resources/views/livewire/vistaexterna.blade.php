<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="card-body">
        <div class="form-group">
            <div class="col-12">
                <input type="number" class="form-control" placeholder="Buscar por DNI" wire:model="buscar">
            </div>
        </div>
        <table class="table table-hover table-sm table-bordered">
                <thead>
                    <tr><th>ID</th><th>DNI</th><th>NOMBRE</th><th>FECHA INGRESO</th><th>OFICINA</th><th>FECHA SALIDA</th><th>ASUNTO</th></tr>
                </thead>
                <tbody>
                    @forelse($consulta as $key)
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

    </div>
    <div class="card-footer clearfix">
        {{ $consulta->links() }} 
    </div>
</div>
