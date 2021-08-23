<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class sgdcontroller extends Controller
{
    //
    public function dependencia()
	{
		//cargados el directorio regional
        $datfuncionario=DB::connection('pgsql')->select('select *from tram_dependencia where (depe_mesa_virtual=1) order by depe_depende asc');
        
     return $datfuncionario;
    }
    public function consultaapidepe($id)
    {
        $consulta='select *from admin where (depe_id='.$id.' and adm_estado=1 )';
        $sql=DB::connection('pgsql')->select($consulta);
        return $sql;

    }
    public function vermesapartes()
	{

     $datos=DB::connection('pgsql')->select('select *from role_user join roles on(role_user.role_id=roles.id) join admin on(role_user.user_id=admin.id) join tram_dependencia on(admin.depe_id=tram_dependencia.iddependencia) WHERE role_id=7 and adm_estado=1 ORDER BY depe_depende asc');
     return view('vermesapartes',compact('datos'));
    }

    public function informaticos()
    {
        //
        $datos=DB::connection('pgsql')->select('select *from role_user join roles on(role_user.role_id=roles.id) join admin on(role_user.user_id=admin.id) join tram_dependencia on(admin.depe_id=tram_dependencia.iddependencia) WHERE role_id<=2 and adm_estado=1 ORDER BY depe_depende asc');
     return view('verinformaticos',compact('datos'));
    }



}
