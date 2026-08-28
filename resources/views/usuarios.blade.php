@extends('plantillas.admin')

@section('titulopagina')
    Administración | Registro de Usuarios
@endsection

@section('titulosuperior')
<div class="col-sm-6">
    <h1>
      Asignación de Portales a Usuarios
      <small>Vincular usuarios del sistema con portales web y roles</small>
    </h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Main</a></li>
      <li class="breadcrumb-item active">Usuarios</li>
    </ol>
</div>
@endsection

@section('contenido')
<div class="container-fluid">
    <div class="row">
        <!-- Formulario para Asignar Usuario a Portal -->
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user-plus"></i> Asignar Portal y Rol a Usuario</h3>
                </div>
                <form class="form" method="POST" action="{{ route('formnewuser') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="iduser">Usuario (Buscar por Apellido/Nombre/DNI)</label>
                            <select name="iduser" id="iduser" class="form-control form-control-sm select2" style="width: 100%;" required>
                                <option value="">-- Buscar y Seleccionar Usuario --</option>
                                @foreach($availableUsers as $u)
                                    <option value="{{ $u->id }}">
                                        {{ $u->adm_lastname }}, {{ $u->adm_name }} [DNI: {{ $u->adm_dni }}] ({{ $u->adm_email }}) - {{ $u->depe_nombre ?? 'Sin dependencia' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="direweb">Portal Web Asignado</label>
                            <select name="direweb" id="direweb" class="form-control form-control-sm select2" style="width: 100%;" required>
                                <option value="">-- Seleccionar Portal --</option>
                                @foreach($paginasweb as $web)
                                    <option value="{{ $web->iddirecciones_web }}">{{ utf8_encode($web->nom_direcciones_web) }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="rol">Rol del Usuario</label>
                            <select name="rol" id="rol" class="form-control form-control-sm select2" style="width: 100%;" required>
                                <option value="">-- Seleccionar Rol --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Guardar Asignación</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Listado de Usuarios Portales -->
        <div class="col-md-8">
            <div class="card card-dark card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users"></i> Listado de Usuarios y Portales Relacionados</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover mb-0">
                            <thead class="bg-secondary">
                                <tr>
                                    <th style="width: 70px;">ID</th>
                                    <th>ID User</th>
                                    <th>Nombre Completo</th>
                                    <th>Portal Web Administrado</th>
                                    <th style="width: 150px;" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($datosuser as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td><code class="text-primary">{{ $user->iduser }}</code></td>
                                    <td><strong>{{ $user->nombreuser }}</strong></td>
                                    <td>
                                        @php
                                            $portal = $paginasweb->firstWhere('iddirecciones_web', $user->iddirecciones_web);
                                        @endphp
                                        @if($portal)
                                            <span class="badge badge-info text-wrap" style="font-size: 85%;">
                                                {{ utf8_encode($portal->nom_direcciones_web) }}
                                            </span>
                                        @else
                                            <span class="text-muted font-italic" style="font-size: 90%;">No asignado (ID: {{ $user->iddirecciones_web }})</span>
                                        @endif
                                    </td>
                                    <td class="text-center" nowrap>
                                        <button class="btn btn-sm btn-info btn-edit-pwd" 
                                                title="Cambiar Contraseña" 
                                                data-toggle="modal" 
                                                data-target="#modal-edit-pwd"
                                                data-id="{{ $user->iduser }}"
                                                data-name="{{ $user->nombreuser }}">
                                            <i class="fa fa-key"></i> Clave
                                        </button>
                                        
                                        <a href="{{ route('eliminauser', $user->id) }}" 
                                           class="btn btn-sm btn-danger" 
                                           title="Eliminar asignación de portal" 
                                           onclick="return confirm('¿Está seguro de eliminar la relación de este usuario con el portal? Esta acción no se puede deshacer.')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center p-4">
                                        <span class="text-muted font-italic">No hay relaciones de usuarios y portales registradas.</span>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Paginación -->
                @if($datosuser->hasPages())
                <div class="card-footer clearfix">
                    <div class="float-right">
                        {{ $datosuser->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal para Cambiar Contraseña -->
<div class="modal fade" id="modal-edit-pwd" tabindex="-1" role="dialog" aria-labelledby="modalEditPwdLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalEditPwdLabel"><i class="fas fa-key"></i> Cambiar Contraseña de Usuario</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('formeditusuario') }}">
                @csrf
                <input type="hidden" name="iduser" id="edit-user-id">
                <div class="modal-body">
                    <div class="alert bg-light border">
                        <span>Usuario: </span><strong class="text-info" id="edit-user-name"></strong>
                    </div>
                    <div class="form-group">
                        <label for="pass">Nueva Contraseña</label>
                        <input type="password" class="form-control" name="pass" id="pass" placeholder="Ingrese nueva contraseña" required minlength="4">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
                    <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Guardar Nueva Clave</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        // Inicializar Select2 en los selects correspondientes
        if ($.fn.select2) {
            $('.select2').select2({
                placeholder: "-- Seleccione --",
                allowClear: true
            });
        }

        // Estilizar paginación
        $("ul.pagination").addClass('pagination-sm m-0 float-right');

        // Modal para editar contraseña
        $('.btn-edit-pwd').click(function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            $('#edit-user-id').val(id);
            $('#edit-user-name').text(name);
            $('#pass').val('');
        });
    });
</script>

<script type="text/javascript">
    @if(Session::has('newuser'))
       toastr.success('{{ Session::get('newuser') }}')
    @endif
    @if(Session::has('danger'))
       toastr.error('{{ Session::get('danger') }}')
    @endif
</script>
@endsection
