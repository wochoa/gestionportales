<?php
namespace App\Http\Controllers;

use App\Http\Requests\VisitaRequest;
use App\Services\Visitas\DependenciaService;
use App\Services\Visitas\FuncionarioService;
use App\Services\Visitas\VisitaService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class VisitaController extends Controller{
    protected $visita;
    protected $dependencia;
    protected $funcionario;

    public function __construct(VisitaService $visita, DependenciaService $dependencia, FuncionarioService $funcionario){

        $this->visita = $visita;
        $this->dependencia = $dependencia;
        $this->funcionario = $funcionario;
    }

    public function index(){
        $dependencias = $this->dependencia->listar();
        return view('visita.index')->
                    with(compact('dependencias'));
    }

    public function listarFuncionarios($dependencia){
        if(request()->ajax()){
            $funcionarios = $this->funcionario->listar($dependencia);

            return Response::json(['funcionarios' => $funcionarios]);
        }
    }

//    public function listarVisitas($portal, $fecha, $criterio){
    public function listarVisitas(Request $request){
        if(request()->ajax()) {
            $data = $request->all();
            $items = $this->visita->listar($data);

            return DataTables::of($items)
                ->addIndexColumn()
                ->addColumn('fechavisita', function($row){
                    return Carbon::createFromFormat('Y-m-d',$row->fechaingreso)->format('d/m/Y');
                })
                ->addColumn('accion', function($row){
                   return '<a onclick="frmSalida('.$row->idregvisita.')" class="btn btn-xs btn-info" title="Registrar Salida"> <i class="fa fa-download"></i></a>';
                })
                ->rawColumns(['accion'])
                ->make(true);
        }
    }

    public function store(VisitaRequest $request){
        if (request()->ajax()) {
            $hay = $this->visita->verificarVisitanteHoy($request->all());
            if ($hay > 0){
                return response()->json([
                    'resultado' => false,
                    'codigo' => 0,
                    'mensaje' => 'La persona se encuentra en el Gobierno Regional, debe registrar su salida para poder registrar otra vez su ingreso...',
                ], 200);
            }

            $this->visita->store($request->all());
            return response()->json([
                'resultado' => true,
                'codigo' => 1,
                'mensaje' => 'Fue registrado la visita',
            ], 200);
        }
    }

    public function edit($id){
        if (request()->ajax()) {
            $item = $this->visita->buscar($id);

            return view('visita.salida')
                ->with(compact('item'));
        }
    }

    public function update(Request $request, $id){
        if (request()->ajax()) {
            $this->visita->update($request->all(), $id);

            return response()->json([
                'resultado' => true,
            ], 200);
        }
    }

    public function indexVisitasExterno($portal){
        $data = DB::connection('pgsql_pag')->table('direcciones_web')->where('iddirecciones_web',$portal)->first();

//        $nombredireccion = DB::connection('pgsql_pag')->table('direcciones_web')->where('iddirecciones_web',$portal)->value('nom_direcciones_web');

        return view('visita.lista')
                    ->with(compact('data'));
    }

    public function listarVisitasExterno(Request $request){
        if(request()->ajax()) {
            $data = $request->all();
            $items = $this->visita->listarExterno($data);

            return DataTables::of($items)
                ->addIndexColumn()
                ->addColumn('fechavisita', function($row){
                    return Carbon::createFromFormat('Y-m-d',$row->fechaingreso)->format('d/m/Y');
                })
                ->make(true);
        }
    }

    public function reporte(){
        return view('visita.reporte');
    }

    public function listarVisitasReporte(Request $request){
        if(request()->ajax()) {
            $data = $request->all();
            $items = $this->visita->listarReporte($data);

            return DataTables::of($items)
                ->addIndexColumn()
                ->addColumn('fechavisita', function($row){
                    return Carbon::createFromFormat('Y-m-d',$row->fechaingreso)->format('d/m/Y');
                })
                ->make(true);
        }
    }

    public function indexVisitasExterno2($portal){
        $data = DB::connection('pgsql_pag')->table('direcciones_web')->where('iddirecciones_web',$portal)->first();
//        $nombredireccion = DB::connection('pgsql_pag')->table('direcciones_web')->where('iddirecciones_web',$portal)->value('nom_direcciones_web');
        return view('visita.indexexterno')
                    ->with(compact('data'));
    }
}
