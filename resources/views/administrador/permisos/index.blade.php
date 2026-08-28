@extends('plantillas.admin')

@section('titulopagina')
    Administración | Permisos
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Gestión de Permisos
      <small>Control de acciones y funcionalidades del sistema</small>
    </h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">Permisos</li>
    </ol>
</div>
@endsection

@section('contenido')
<div class="container-fluid">
    <div class="row">
        <!-- Panel de Creación de Permiso -->
        @if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('permisos_crear'))
        <div class="col-md-4">
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title text-dark"><i class="fas fa-key"></i> Nuevo Permiso</h3>
                </div>
                <form method="POST" action="{{ route('permisos.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nombre del Permiso</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Ej. modulo_reporte_ver" required value="{{ old('name') }}">
                            <small class="form-text text-muted">Use minúsculas y guiones bajos (ej. ver_visitas, editar_roles).</small>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-warning btn-sm text-dark"><i class="fa fa-save"></i> Guardar Permiso</button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <!-- Panel de Listado de Permisos -->
        <div class="@if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('permisos_crear')) col-md-8 @else col-md-12 @endif">
            <div class="card card-dark card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-lock"></i> Listado de Permisos Registrados</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover mb-0">
                            <thead class="bg-secondary">
                                <tr>
                                    <th style="width: 80px;">ID</th>
                                    <th>Nombre del Permiso</th>
                                    <th>Guard</th>
                                    <th style="width: 100px;" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permissions as $perm)
                                <tr>
                                    <td>{{ $perm->id }}</td>
                                    <td>
                                        <span class="badge badge-warning text-dark font-weight-bold" style="font-size: 90%;">{{ $perm->name }}</span>
                                    </td>
                                    <td><code class="text-secondary">{{ $perm->guard_name }}</code></td>
                                    <td class="text-center">
                                        @if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('permisos_eliminar'))
                                        <form action="{{ route('permisos.destroy', $perm->id) }}" method="POST" class="d-inline form-delete-permission">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar Permiso" onclick="return confirm('¿Está seguro de eliminar este permiso? Esto podría afectar a los roles asignados.')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        @else
                                            <span class="text-muted font-italic">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center p-4">
                                        <span class="text-muted">No hay permisos registrados en el sistema.</span>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Paginación -->
                @if($permissions->hasPages())
                <div class="card-footer clearfix">
                    <div class="float-right">
                        {{ $permissions->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        // Estilizar la paginación de Bootstrap para AdminLTE
        $("ul.pagination").addClass('pagination-sm m-0 float-right');
    });
</script>

<script type="text/javascript">
    @if(Session::has('success'))
       toastr.success('{{ Session::get('success') }}')
    @endif
    @if(Session::has('error'))
       toastr.error('{{ Session::get('error') }}')
    @endif
</script>
@endsection
