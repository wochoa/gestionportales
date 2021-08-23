<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create permissions
        Permission::create(['name' => 'Pagina_crearticket']);// pagina ticket
        Permission::create(['name' => 'Pagina_misticket']);// pagina mis ticket
        Permission::create(['name' => 'Pagina_reporteticket']);// pagina reporte ticket
        Permission::create(['name' => 'Ticket_leer']);
        Permission::create(['name' => 'Ticket_crear']);
        Permission::create(['name' => 'Ticket_editar']);
        Permission::create(['name' => 'Ticket_eliminar']);
        Permission::create(['name' => 'Pagina_chat']);// pagina chat
        Permission::create(['name' => 'crear_chat']);
        Permission::create(['name' => 'Pagina_mioficina']);//pagina mi oficina
        Permission::create(['name' => 'Pagina_personalsoporte']);
        Permission::create(['name' => 'pagina_userSGD']);// pagina  usuarios sgd
        Permission::create(['name' => 'UsuarioSGD_rol']);// puede asignar rol
        Permission::create(['name' => 'Pagina_roles']);// pagina de roles
        Permission::create(['name' => 'roles_leer']);
        Permission::create(['name' => 'roles_crear']);
        Permission::create(['name' => 'roles_editar']);
        Permission::create(['name' => 'roles_eliminar']);
        Permission::create(['name' => 'Pagina_permisos']);// pagina de permisos
        Permission::create(['name' => 'permisos_leer']);
        Permission::create(['name' => 'permisos_crear']);
        Permission::create(['name' => 'permisos_editar']);
        Permission::create(['name' => 'permisos_eliminar']);
        Permission::create(['name' => 'Pagina_catatenciones']);// pagina de categoria de atenciones
        Permission::create(['name' => 'catatenciones_leer']);
        Permission::create(['name' => 'catatenciones_crear']);
        Permission::create(['name' => 'catatenciones_editar']);
        Permission::create(['name' => 'catatenciones_eliminar']);
        Permission::create(['name' => 'Pagina_inventario']);// pagina de inventario -- falta crear todo
        Permission::create(['name' => 'inventario_leer']);
        Permission::create(['name' => 'inventario_crear']);
        Permission::create(['name' => 'inventario_editar']);
        Permission::create(['name' => 'inventario_eliminar']);
        // create roles and assign existing permissions
        $admin = Role::create(['name' => 'Superadmin']);
        $empleado = Role::create(['name' => 'Administrador']);
        $soporte = Role::create(['name' => 'Soporte']);
        $usuario = Role::create(['name' => 'Usuario']);

        // asignacion de roles y permisos

        $admin->givePermissionTo(
            [
                'Pagina_crearticket',
                'Pagina_misticket',
                'Pagina_reporteticket',
                'Ticket_leer',
                'Ticket_crear',
                'Ticket_editar',
                'Ticket_eliminar',
                'Pagina_chat',
                'crear_chat',
                'Pagina_mioficina',
                'Pagina_personalsoporte',
                'pagina_userSGD',
                'UsuarioSGD_rol',
                'Pagina_roles',
                'roles_leer',
                'roles_crear',
                'roles_editar',
                'roles_eliminar',
                'Pagina_permisos',
                'permisos_leer',
                'permisos_crear',
                'permisos_editar',
                'permisos_eliminar',
                'Pagina_catatenciones',
                'catatenciones_leer',
                'catatenciones_crear',
                'catatenciones_editar',
                'catatenciones_eliminar',
                'Pagina_inventario',
                'inventario_leer',
                'inventario_crear',
                'inventario_editar',
                'inventario_eliminar'
            ]
        );

       // create a demo user
      $user = Factory(App\User::class)->create([
          'adm_name' => 'WILMER',
          'adm_lastname' => 'OCHOA ALVARADO',
          'adm_estado' => '1',
          'depe_id' => '2',
          'adm_correo' => 'woalvarado1@gmail.com',
          'adm_dni'=>'42282733',
          'adm_email'=>'WOCHOA2',
          // factory default password is 'password'
      ]);
      $user->assignRole($admin);
    }
}
