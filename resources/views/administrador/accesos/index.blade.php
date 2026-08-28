@extends('plantillas.admin')

@section('titulopagina')
    Administración | Accesos de Usuarios
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Asignación de Roles y Accesos
      <small>Asignar roles a usuarios activos del sistema</small>
    </h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">Accesos</li>
    </ol>
</div>
@endsection

@section('contenido')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-dark card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users-cog"></i> Usuarios Activos (adm_estado = 1)</h3>
                    
                    <div class="card-tools">
                        <!-- Filtro de Búsqueda -->
                        <form method="GET" action="{{ route('accesos.index') }}" class="form-inline ml-3">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="q" class="form-control float-right" placeholder="Buscar por Nombre, DNI o Email..." value="{{ request('q') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    @if(request('q'))
                                        <a href="{{ route('accesos.index') }}" class="btn btn-default" title="Limpiar filtro">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover mb-0">
                            <thead class="bg-secondary">
                                <tr>
                                    <th style="width: 70px;">ID</th>
                                    <th>DNI</th>
                                    <th>Apellidos y Nombres</th>
                                    <th>Usuario / Email</th>
                                    <th>Cargo</th>
                                    <th>Roles Asignados</th>
                                    <th style="width: 150px;" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->adm_dni }}</td>
                                    <td>
                                        <strong>{{ $user->adm_lastname }}, {{ $user->adm_name }}</strong>
                                    </td>
                                    <td>
                                        <div><i class="fas fa-user-circle text-muted"></i> {{ $user->adm_email }}</div>
                                        @if($user->adm_correo)
                                            <small class="text-muted"><i class="fas fa-envelope"></i> {{ $user->adm_correo }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-secondary" style="font-size: 90%;">{{ $user->adm_cargo ?? 'No especificado' }}</span>
                                    </td>
                                    <td>
                                        @forelse($user->roles as $role)
                                            <span class="badge badge-success mb-1" style="font-size: 85%;">{{ $role->name }}</span>
                                        @empty
                                            <span class="text-muted font-italic" style="font-size: 90%;">Sin roles asignados</span>
                                        @endforelse
                                    </td>
                                    <td class="text-center">
                                        @if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('UsuarioSGD_rol'))
                                        <button class="btn btn-sm btn-info btn-assign-roles" 
                                                title="Asignar Roles"
                                                data-toggle="modal" 
                                                data-target="#modal-assign-roles"
                                                data-id="{{ $user->id }}"
                                                data-fullname="{{ $user->adm_name }} {{ $user->adm_lastname }}"
                                                data-roles="{{ json_encode($user->roles->pluck('id')) }}">
                                            <i class="fas fa-user-shield"></i> Asignar Roles
                                        </button>
                                        @else
                                            <span class="text-muted font-italic">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center p-4">
                                        <span class="text-muted">No se encontraron usuarios activos con los criterios de búsqueda.</span>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Paginación -->
                @if($users->hasPages())
                <div class="card-footer clearfix">
                    <div class="float-right">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal para Asignar Roles a Usuario -->
@if(auth()->user()->hasRole('Superadmin') || auth()->user()->can('UsuarioSGD_rol'))
<div class="modal fade" id="modal-assign-roles" tabindex="-1" role="dialog" aria-labelledby="modalAssignRolesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="modalAssignRolesLabel"><i class="fas fa-user-shield"></i> Administrar Roles de Usuario</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-assign-roles" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="alert bg-light border mb-4">
                        <h5>Usuario seleccionado:</h5>
                        <p class="mb-0 font-weight-bold text-success" id="user-fullname-display" style="font-size: 110%;"></p>
                    </div>

                    <div class="card card-outline card-success">
                        <div class="card-header py-2">
                            <h3 class="card-title font-weight-bold text-success"><i class="fas fa-user-tag"></i> Roles Disponibles</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse($roles as $role)
                                    <div class="col-md-4 col-sm-6 mb-3">
                                        <div class="custom-control custom-checkbox border rounded p-2 bg-light">
                                            <input class="custom-control-input user-role-checkbox" 
                                                   type="checkbox" 
                                                   name="roles[]" 
                                                   id="role-checkbox-{{ $role->id }}" 
                                                   value="{{ $role->name }}">
                                            <label class="custom-control-label font-weight-normal text-wrap" 
                                                   for="role-checkbox-{{ $role->id }}" 
                                                   style="cursor: pointer; display: block; font-size: 90%;">
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-3">
                                        <span class="text-muted">No hay roles registrados en el sistema.</span>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Asignación</button>
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
        // Estilizar la paginación de Bootstrap para AdminLTE
        $("ul.pagination").addClass('pagination-sm m-0 float-right');

        // Evento al abrir el modal de asignar roles
        $('.btn-assign-roles').click(function() {
            var id = $(this).data('id');
            var fullname = $(this).data('fullname');
            var roles = $(this).data('roles'); // Array de IDs de roles del usuario

            var form = $('#form-assign-roles');
            // Reemplazar la acción del formulario con la ruta correspondiente
            form.attr('action', '/administrador/accesos/' + id);
            $('#user-fullname-display').text(fullname);

            // Desmarcar todos los checkboxes primero
            $('.user-role-checkbox').prop('checked', false);

            // Marcar los roles que tiene el usuario
            if (roles && Array.isArray(roles)) {
                roles.forEach(function(roleId) {
                    $('#role-checkbox-{{ "" }}' + roleId).prop('checked', true);
                });
            }
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
