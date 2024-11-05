<?php
namespace App\Services\Visitas;

use App\Visita;
use Carbon\Carbon;

class VisitaService{
    protected $modelo;

    public function __construct(Visita $visita){
        $this->modelo = $visita;
    }

    public function listar($data){
        $fecha = $data['fecha'];
        $fechas = explode(' - ', $fecha);
        $fechainicio =  Carbon::createFromFormat('d/m/Y',$fechas[0])->format('Y-m-d');
        $fechafinal = Carbon::createFromFormat('d/m/Y',$fechas[1])->format('Y-m-d');

        $query = $this->modelo->selectRaw("idregvisita,
                                           CAST(fechaingreso AS DATE) AS fechaingreso,
                                           nombre,
                                           dni,
                                           institucion,
                                           CASE WHEN cargo IS NULL THEN nom_funcionario ELSE
                                           CONCAT(nom_funcionario, ' - ', nom_oficina, ' - ', cargo) END AS funcionario,
                                           CAST(fechaingreso AS TIME) AS horaingreso,
                                           CAST(fechasalida AS TIME) AS horasalida,
                                           motivo,
                                           CASE WHEN lugar IS NULL THEN nom_oficina ELSE lugar END as lugar,
                                           observaciones")
                        ->where('estado',1)
                        ->where('iddirecciones_web',$data['portal'])
                        ->whereRaw("CAST(fechaingreso AS DATE) BETWEEN '".$fechainicio."' AND '".$fechafinal."' ");
        if(isset($data['busqueda'])){
            $query->whereRaw("nombre like '%".$data['busqueda']."%' or dni like '%".$data['busqueda']."%'
                            or institucion like '%".$data['busqueda']."%' or CONCAT(nom_funcionario, ' - ', cargo) like '%".$data['busqueda']."%'");
        }
 	if($data['oficodigo'] == 11){
            $query->where("ofi_codigo", $data['oficodigo']);
        }

        $datos = $query->get();
        return $datos;
    }

    public function verificarVisitanteHoy($data){
        $datos = $this->modelo
            ->whereRaw("CAST(fechaingreso AS DATE) = '".Carbon::today()->format('Y-m-d')."'")
            ->where('estado', 1)
            ->where('dni', $data['dni'])
            ->get();

        return $datos->count();
    }

    public function listarExterno($data){
	$fecha = $data['fecha'];
        $fechas = explode(' - ', $fecha);
        $fechainicio =  Carbon::createFromFormat('d/m/Y',$fechas[0])->format('Y-m-d');
        $fechafinal = Carbon::createFromFormat('d/m/Y',$fechas[1])->format('Y-m-d');

        $query = $this->modelo->selectRaw("idregvisita,
                                       CAST(fechaingreso AS DATE) AS fechaingreso,
                                       nombre,
                                       dni,
                                       institucion,
                                       CASE WHEN cargo IS NULL THEN nom_funcionario ELSE
                                       CONCAT(nom_funcionario, ' - ', nom_oficina, ' - ', cargo) END AS funcionario,
                                       CAST(fechaingreso AS TIME) AS horaingreso,
                                       CAST(fechasalida AS TIME) AS horasalida,
                                       motivo,
                                       CASE WHEN lugar IS NULL THEN nom_oficina ELSE lugar END as lugar,
                                       observaciones")
                    ->where('iddirecciones_web',$data['portal'])
                    ->whereRaw("CAST(fechaingreso AS DATE) BETWEEN '".$fechainicio."' AND '".$fechafinal."' ");

        if(isset($data['busqueda'])){
            $query->whereRaw("nombre like '%".$data['busqueda']."%' or dni like '%".$data['busqueda']."%'
                            or institucion like '%".$data['busqueda']."%' or CONCAT(nom_funcionario, ' - ', cargo) like '%".$data['busqueda']."%'");
        }
        $datos = $query->get();

        return $datos;
    }

    public function store($data){
        $institucion = "Persona Natural: a titulo personal";
        if($data['tipopersona'] == "Entidad P�blica"){
            $institucion = "Entidad P�blica: ".$data['institucion'];
        }
        if($data['tipopersona'] == "Entidad Privada"){
            $institucion = "Entidad Privada: ".$data['institucion'];
        }

        return $this->modelo->create([
            'dni' => $data['dni'],
            'nombre' => $data['nombre'],
            'motivo' => $data['motivo'],
            'fechaingreso' => Carbon::now(),
            'estado' => 1,
            'ofi_codigo' => $data['oficodigo'],
            'nom_oficina' => $data['nomoficina'],
            'nom_funcionario' => $data['nomfuncionario'],
            'tipo_persona' => $data['tipopersona'],
            'iddirecciones_web' => $data['iddireccionesweb'],
            'institucion' => $institucion,
            'cargo' => $data['cargo'],
            'lugar' => $data['lugar'],
        ]);
    }

    public function update($data, $id){
        $modelo = $this->buscar($id);
        $modelo->observaciones = $data['observaciones'];
        $modelo->fechasalida = Carbon::now();
        $modelo->estado = 2;
        $modelo->save();

        return $modelo;
    }

    public function buscar($id){
        return $this->modelo->where('idregvisita',$id)->first();
    }

    public function buscarPor($field, $value, $columns = array('*')){
        return $this->modelo->where($field, '=', $value)->first($columns);
    }

    public function listarReporte($data){
        $fecha = $data['fecha'];
        $fechas = explode(' - ', $fecha);
        $fechainicio =  Carbon::createFromFormat('d/m/Y',$fechas[0])->format('Y-m-d');
        $fechafinal = Carbon::createFromFormat('d/m/Y',$fechas[1])->format('Y-m-d');

        $query = $this->modelo->selectRaw("idregvisita,
                                       CAST(fechaingreso AS DATE) AS fechaingreso,
                                       nombre,
                                       dni,
                                       institucion,
                                       CASE WHEN cargo IS NULL THEN nom_funcionario ELSE
                                       CONCAT(nom_funcionario, ' - ', nom_oficina, ' - ', cargo) END AS funcionario,
                                       CAST(fechaingreso AS TIME) AS horaingreso,
                                       CAST(fechasalida AS TIME) AS horasalida,
                                       motivo,
                                       CASE WHEN lugar IS NULL THEN nom_oficina ELSE lugar END as lugar,
                                       observaciones")
            ->where('iddirecciones_web',$data['portal'])
            ->whereRaw("CAST(fechaingreso AS DATE) BETWEEN '".$fechainicio."' AND '".$fechafinal."' ");

        if(isset($data['busqueda'])){
            $query->whereRaw("nombre like '%".$data['busqueda']."%' or dni like '%".$data['busqueda']."%'
                            or institucion like '%".$data['busqueda']."%' or CONCAT(nom_funcionario, ' - ', cargo) like '%".$data['busqueda']."%'");
        }
        if($data['oficodigo'] == 11){
            $query->where("ofi_codigo", $data['oficodigo']);
        }
        $datos = $query->get();

        return $datos;
    }
}
