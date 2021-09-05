<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Component;

class Visitas extends Component
{
    use WithPagination;

    public $ndni;
    public $nombres;
    public $iprocedencia;
    public $codoficina;
    public $motivo;
    public $nomfuncionario;
    public $nomoficina;
    public $idweb;
    public $foto;

    public $dnisalida;


    protected $listeners = ['Iniciavadni'];
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->codoficina=0;
    }
    public function render()
    {
        // consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->value('iddirecciones_web');
		$idpaginaweb = $accesoweb;//$accesoweb[0]->iddirecciones_web;// sacamos la id de la direccion web en este caso 11= Gobierno regional Huanuco
        $this->idweb=$idpaginaweb;

        $iddepen=DB::connection('mysql')->table('direcciones_web')->where('iddirecciones_web',$idpaginaweb)->value('iddependencia');// consultamos para sacar la id de dependencia

        $unidadorganica=DB::table('dependencia')->where('depe_depende',$iddepen)->orderBy('iddependencia','ASC')->get();

        $regvisita=DB::connection('mysql')->table('regvisita')->where(['estado'=>1,'iddirecciones_web'=>$idpaginaweb])->paginate(10);

        return view('livewire.visitas', compact('unidadorganica','regvisita'));
    }

    public function busofifuncionario($id)
    {
        if($id<>0)
        {
            $dato=DB::table('dependencia')->where('iddependencia',$id)->get();
            $this->nomfuncionario=$dato[0]->depe_representante;
            $this->codoficina=$dato[0]->iddependencia;
            $this->nomoficina=$dato[0]->depe_nombre;
        }
    }

    public function registravisita()
    {
        $this->validate(['ndni'=>'required',
                        'nombres'=>'required',
                        'iprocedencia'=>'required', 
                        'codoficina'=>'required',
                        'motivo'=>'required'                       
          ]);
        //   $this->busofifuncionario($this->codoficina);
          $fecha=date('Y-m-d H:i:s');
          DB::connection('mysql')->insert('insert into regvisita (dni, nombre,motivo,fechaingreso,ofi_codigo,nom_oficina,nom_funcionario,iprocedencia,iddirecciones_web,created_at) values (?, ?,?,?,?,?,?,?,?,?)', [
              $this->ndni,
              $this->nombres,
              $this->motivo,
              $fecha,
              $this->codoficina,
              $this->nomoficina,
              $this->nomfuncionario,
              $this->iprocedencia,
              $this->idweb,
              $fecha]);

        $this->limpiar();
        $this->emit('regvisita');
    }
    public function limpiar()
    {
        $this->ndni='';
        $this->nombres='';
        $this->codoficina=0;
        $this->motivo='';
    }
    // public function buscardni()
    // {
    //     $url='https://app.regionhuanuco.gob.pe/soap_pruebas/reniec.php?cdni='.$this->ndni;

    //     $wsdl = file_get_contents($url);
    //     return $wsdl;
    // }

    public function Iniciavadni($datos)
    {
        $this->nombres= $datos['prenombres'].' '.$datos['apPrimer'].' '.$datos['apSegundo'];
        $this->iprocedencia= "PERSONA NATURAL";
        $this->foto='<img src="data:image/jpg;base64,'.$datos['foto'].'">';
    }

    public function Regsalida()
    {
        $this->validate(['dnisalida'=>'required']);
        $datos=DB::connection('mysql')->table('regvisita')->where(['dni'=>$this->dnisalida,'estado'=>1])->orderBy('idregvisita','DESC')->get();

        $iduser=@$datos[0]->idregvisita;
        $fechasalida=date("Y-m-d H:i:s");

        $consulta="UPDATE regvisita SET estado='2', fechasalida='$fechasalida' WHERE idregvisita='$iduser'";
        if($iduser)
        {
            DB::connection('mysql')->update($consulta);
            $this->emit('dnisalida');
        }
        else{
            $this->emit('dninoexiste');
        }
        //return $datos[0]->idregvisita;
    }
}
