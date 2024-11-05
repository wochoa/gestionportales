<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   

         // paginas web creadas
         $iduser=auth()->user()->id;

         $idpaginaweb=DB::connection('pgsql_pag')->table('userportales')->where('iduser',$iduser)->value('iddirecciones_web');
         $nombreportalweb=DB::connection('pgsql_pag')->table('direcciones_web')->where('iddirecciones_web',$idpaginaweb)->value('nom_direcciones_web');
		
         
         $dirweb = DB::connection('pgsql_pag')->table('direcciones_web')->where('dns_direcciones_web','!=',null)->OrderBy('iddirecciones_web', 'desc')->get();
         $dirweb2 = DB::connection('pgsql_pag')->table('direcciones_web')->where('linkdirecciones_web','!=',null)->OrderBy('iddirecciones_web', 'desc')->get();

         // consulta para sacar el rol para la persona
         $colroles=DB::table('model_has_roles')->join('roles','model_has_roles.role_id','=','roles.id')->where('model_id',$iduser)->get();
 
 
         // total de usuarios creados
         $usuarios=DB::table('admin')->get(); 

        // ponemos la regla de permisos
        if(Auth::user()->can('acceso_gestionportales'))
        {
            return view('main', compact('dirweb','dirweb2','usuarios','nombreportalweb','colroles'));
        }
        else{
            return view('noacceso');
            // return redirect('/login');
        }
  
        
    }
}
