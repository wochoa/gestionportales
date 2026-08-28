@extends('plantillas.admin')

@section('titulopagina')
    Administración | Roles
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Gestión de Roles
      <small>Administración de accesos del sistema</small>
    </h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">Roles</li>
    </ol>
</div>
@endsection

@section('contenido')
<div class="container-fluid">
    <div class="row">
        <!-- Panel de Creación de Rol -->
        @if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('roles_crear'))
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-plus-circle"></i> Nuevo Rol</h3>
                </div>
                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nombre del Rol</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Ej. Administrador de Visitas" required value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Guardar Rol</button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <!-- Panel de Listado de Roles -->
        <div class="@if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('roles_crear')) col-md-8 @else col-md-12 @endif">
            <div class="card card-dark card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user-tag"></i> Listado de Roles Existentes</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover mb-0">
                            <thead class="bg-secondary">
                                <tr>
                                    <th style="width: 80px;">ID</th>
                                    <th>Nombre del Rol</th>
                                    <th>Permisos Asignados</th>
                                    <th style="width: 150px;" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>
                                        <strong>{{ $role->name }}</strong>
                                    </td>
                                    <td>
                                        @forelse($role->permissions as $perm)
                                            <span class="badge badge-info mb-1" style="font-size: 85%;">{{ $perm->name }}</span>
                                        @empty
                                            <span class="text-muted font-italic" style="font-size: 90%;">Ningún permiso asignado</span>
                                        @endforelse
                                    </td>
                                    <td class="text-center" nowrap>
                                        @if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('roles_editar'))
                                        <button class="btn btn-sm btn-info btn-edit-role" 
                                                title="Editar permisos"
                                                data-toggle="modal" 
                                                data-target="#modal-edit-role"
                                                data-id="{{ $role->id }}"
                                                data-name="{{ $role->name }}"
                                                data-permissions="{{ json_encode($role->permissions->pluck('id')) }}">
                                            <i class="fa fa-edit"></i> Editar
                                        </button>
                                        @endif

                                        @if((auth()->user()->hasRole('Superadmin') || auth()->user()->can('roles_eliminar')) && !in_array($role->name, ['Superadmin', 'Administrador']))
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline form-delete-role">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar Rol" onclick="return confirm('¿Está seguro de eliminar este rol? Esta acción no se puede deshacer.')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center p-4">
                                        <span class="text-muted">No hay roles registrados en el sistema.</span>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar Rol y Asignar Permisos -->
@if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('roles_editar'))
<div class="modal fade" id="modal-edit-role" tabindex="-1" role="dialog" aria-labelledby="modalEditRoleLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="modalEditRoleLabel"><i class="fas fa-edit"></i> Editar Rol y Permisos</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-edit-role" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="edit-role-name">Nombre del Rol</label>
                        <input type="text" class="form-control" id="edit-role-name" name="name" required placeholder="Nombre del Rol">
                    </div>

                    <div class="card card-outline card-secondary">
                        <div class="card-header py-2">
                            <h3 class="card-title font-weight-bold text-secondary"><i class="fas fa-shield-alt"></i> Asignación de Permisos</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-xs btn-default" id="btn-select-all-perms">Seleccionar Todos</button>
                                <button type="button" class="btn btn-xs btn-default" id="btn-deselect-all-perms">Deseleccionar Todos</button>
                            </div>
                        </div>
                        <div class="card-body" style="max-height: 450px; overflow-y: auto;">
                            <div class="row">
                                @forelse($permissions as $perm)
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="custom-control custom-checkbox border rounded p-2 bg-light">
                                            <input class="custom-control-input edit-permission-checkbox" 
                                                   type="checkbox" 
                                                   name="permissions[]" 
                                                   id="edit-perm-{{ $perm->id }}" 
                                                   value="{{ $perm->name }}">
                                            <label class="custom-control-label font-weight-normal text-wrap" 
                                                   for="edit-perm-{{ $perm->id }}" 
                                                   style="cursor: pointer; display: block; font-size: 85%;">
                                                {{ $perm->name }}
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-3">
                                        <span class="text-muted">No hay permisos registrados en el sistema.</span>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
                    <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        // Evento al abrir el modal de editar rol
        $('.btn-edit-role').click(function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var permissions = $(this).data('permissions'); // Array de IDs de permisos

            var form = $('#form-edit-role');
            // Reemplazar la acción del formulario con el ID actual
            form.attr('action', '/administrador/roles/' + id + '/update');
            $('#edit-role-name').val(name);

            // Desmarcar todos los checkboxes primero
            $('.edit-permission-checkbox').prop('checked', false);

            // Marcar los permisos que tiene el rol
            if (permissions && Array.isArray(permissions)) {
                permissions.forEach(function(permId) {
                    $('#edit-perm-' + permId).prop('checked', true);
                });
            }
        });

        // Botón Seleccionar Todos
        $('#btn-select-all-perms').click(function() {
            $('.edit-permission-checkbox').prop('checked', true);
        });

        // Botón Deseleccionar Todos
        $('#btn-deselect-all-perms').click(function() {
            $('.edit-permission-checkbox').prop('checked', false);
        });
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
