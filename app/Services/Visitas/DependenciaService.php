<?php
namespace App\Services\Visitas;

use App\Dependencia;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;

class DependenciaService{
    protected $modelo;
    protected $helper;

    public function __construct(Dependencia $dependencia, Helper $helper){
        $this->modelo = $dependencia;
        $this->helper = $helper;
    }

    public function listar(){
        $idpaginaweb = Helper::verificarAcceso();

        $iddepen = DB::connection('pgsql_pag')->table('direcciones_web')->where('iddirecciones_web',$idpaginaweb)->value('iddependencia');// consultamos para sacar la id de dependencia
        $datos = $this->modelo->select('iddependencia','depe_nombre')->where('depe_depende',$iddepen)->orderBy('depe_nombre','ASC')->get();

        return $datos;
    }
}
