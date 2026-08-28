<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class AdministracionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Clear Spatie permission cache.
     */
    protected function clearCache()
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    /**
     * Roles Management
     */
    public function indexRoles()
    {
        abort_if(!auth()->user()->hasRole('Superadmin') && !auth()->user()->can('Pagina_roles'), 403, 'No tiene acceso a la página de Roles.');

        $roles = Role::where('guard_name', 'api')->orderBy('name', 'asc')->get();
        $permissions = Permission::where('guard_name', 'api')->orderBy('name', 'asc')->get();

        return view('administrador.roles.index', compact('roles', 'permissions'));
    }

    public function storeRole(Request $request)
    {
        abort_if(!auth()->user()->hasRole('Superadmin') && !auth()->user()->can('roles_crear'), 403, 'No tiene acceso para crear roles.');

        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        Role::create([
            'name' => $request->name,
            'guard_name' => 'api'
        ]);

        $this->clearCache();

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    public function updateRole(Request $request, $id)
    {
        abort_if(!auth()->user()->hasRole('Superadmin') && !auth()->user()->can('roles_editar'), 403, 'No tiene acceso para editar roles.');

        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id
        ]);

        $role->name = $request->name;
        $role->save();

        // Sync permissions if provided
        $permissions = $request->input('permissions', []);
        $role->syncPermissions($permissions);

        $this->clearCache();

        return redirect()->route('roles.index')->with('success', 'Rol y permisos actualizados correctamente.');
    }

    public function destroyRole($id)
    {
        abort_if(!auth()->user()->hasRole('Superadmin') && !auth()->user()->can('roles_eliminar'), 403, 'No tiene acceso para eliminar roles.');

        $role = Role::findOrFail($id);
        $role->delete();

        $this->clearCache();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente.');
    }

    /**
     * Permissions Management
     */
    public function indexPermisos()
    {
        abort_if(!auth()->user()->hasRole('Superadmin') && !auth()->user()->can('Pagina_permisos'), 403, 'No tiene acceso a la página de Permisos.');

        $permissions = Permission::where('guard_name', 'api')->orderBy('name', 'asc')->paginate(20);

        return view('administrador.permisos.index', compact('permissions'));
    }

    public function storePermiso(Request $request)
    {
        abort_if(!auth()->user()->hasRole('Superadmin') && !auth()->user()->can('permisos_crear'), 403, 'No tiene acceso para crear permisos.');

        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => 'api'
        ]);

        $this->clearCache();

        return redirect()->route('permisos.index')->with('success', 'Permiso creado exitosamente.');
    }

    public function destroyPermiso($id)
    {
        abort_if(!auth()->user()->hasRole('Superadmin') && !auth()->user()->can('permisos_eliminar'), 403, 'No tiene acceso para eliminar permisos.');

        $permission = Permission::findOrFail($id);
        $permission->delete();

        $this->clearCache();

        return redirect()->route('permisos.index')->with('success', 'Permiso eliminado exitosamente.');
    }

    /**
     * User Access Control (Assign Roles to Active Users)
     */
    public function indexAccesos(Request $request)
    {
        abort_if(!auth()->user()->hasRole('Superadmin') && !auth()->user()->can('UsuarioSGD_rol'), 403, 'No tiene acceso a la página de Asignación de Roles.');

        $query = User::where('adm_estado', '1')->whereNotNull('adm_inicial');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('adm_name', 'like', "%$q%")
                    ->orWhere('adm_lastname', 'like', "%$q%")
                    ->orWhere('adm_dni', 'like', "%$q%")
                    ->orWhere('adm_email', 'like', "%$q%");
            });
        }

        $users = $query->orderBy('id', 'asc')->paginate(15);
        $roles = Role::where('guard_name', 'api')->orderBy('name', 'asc')->get();

        return view('administrador.accesos.index', compact('users', 'roles'));
    }

    public function updateAcceso(Request $request, $id)
    {
        abort_if(!auth()->user()->hasRole('Superadmin') && !auth()->user()->can('UsuarioSGD_rol'), 403, 'No tiene acceso para asignar roles.');

        $user = User::findOrFail($id);
        
        $roles = $request->input('roles', []);
        $user->syncRoles($roles);

        $this->clearCache();

        return redirect()->route('accesos.index')->with('success', 'Roles actualizados y aplicados inmediatamente al usuario.');
    }
}
