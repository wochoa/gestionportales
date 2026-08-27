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
                        ->where('estado', 1)
                        ->where('iddirecciones_web', $data['portal'])
                        ->whereBetween('fechaingreso', [$fechainicio . ' 00:00:00', $fechafinal . ' 23:59:59']);

        if (!empty($data['busqueda'])) {
            $busqueda = '%' . $data['busqueda'] . '%';
            $query->where(function ($q) use ($busqueda) {
                $q->where('nombre', 'ILIKE', $busqueda)
                  ->orWhere('dni', 'ILIKE', $busqueda)
                  ->orWhere('institucion', 'ILIKE', $busqueda)
                  ->orWhereRaw("CONCAT(nom_funcionario, ' - ', cargo) ILIKE ?", [$busqueda]);
            });
        }

        if ($data['oficodigo'] == 11) {
            $query->where("ofi_codigo", $data['oficodigo']);
        }

        return $query->get();
    }

    public function verificarVisitanteHoy($data){
        return $this->modelo
            ->where('estado', 1)
            ->where('dni', $data['dni'])
            ->whereBetween('fechaingreso', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
            ->count();
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
                    ->where('iddirecciones_web', $data['portal'])
                    ->whereBetween('fechaingreso', [$fechainicio . ' 00:00:00', $fechafinal . ' 23:59:59']);

        if (!empty($data['busqueda'])) {
            $busqueda = '%' . $data['busqueda'] . '%';
            $query->where(function ($q) use ($busqueda) {
                $q->where('nombre', 'ILIKE', $busqueda)
                  ->orWhere('dni', 'ILIKE', $busqueda)
                  ->orWhere('institucion', 'ILIKE', $busqueda)
                  ->orWhereRaw("CONCAT(nom_funcionario, ' - ', cargo) ILIKE ?", [$busqueda]);
            });
        }

        return $query->get();
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
            ->where('iddirecciones_web', $data['portal'])
            ->whereBetween('fechaingreso', [$fechainicio . ' 00:00:00', $fechafinal . ' 23:59:59']);

        if (!empty($data['busqueda'])) {
            $busqueda = '%' . $data['busqueda'] . '%';
            $query->where(function ($q) use ($busqueda) {
                $q->where('nombre', 'ILIKE', $busqueda)
                  ->orWhere('dni', 'ILIKE', $busqueda)
                  ->orWhere('institucion', 'ILIKE', $busqueda)
                  ->orWhereRaw("CONCAT(nom_funcionario, ' - ', cargo) ILIKE ?", [$busqueda]);
            });
        }

        if ($data['oficodigo'] == 11) {
            $query->where("ofi_codigo", $data['oficodigo']);
        }

        return $query->get();
    }
}
