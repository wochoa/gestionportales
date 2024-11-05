<?php
namespace App\Services\Visitas;

use App\Funcionario;
use App\Helpers\Helper;

class FuncionarioService{
    protected $modelo;
    protected $helper;

    public function __construct(Funcionario $funcionario, Helper $helper){
        $this->modelo = $funcionario;
        $this->helper = $helper;
    }

    public function listar($dependencia){
        $datos = $this->modelo->selectRaw("CONCAT(adm_name, ' ', adm_lastname, ' / ', adm_cargo) as valor,
                                CONCAT(adm_name, ' ', adm_lastname) as funcionario,
                                adm_cargo as cargo")
                    ->where('depe_id', $dependencia)
                    ->where('adm_estado', 1)
                    ->orderBy('valor','asc')
                    ->get();

        return $datos;
    }
}
