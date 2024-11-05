<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Visitas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
		//$this->middleware('auth')->only('create','store');// aqui protegemos solo create y store
		//$this->middleware('auth')->except('index'); // aqui protegemos a todos excepto las
        $this->middleware('auth');
	}

    public function index()
    {
        
        

        return view('regvisita');
        // return $dirweb[0]->iddependencia;
    }

    public function reniec($id)
    {
        $url='http://app.regionhuanuco.gob.pe/soap_pruebas/reniec.php?cdni='.$id.'&key=j53e130xRfEV1KYH1W2m57HToKRtaIYGKn0RlBqQUf9l2pCh8ewoK1inHj5HdVGb';

        $wsdl = file_get_contents($url);
        return $wsdl;
    }

    public function reportevisit()
    {
        $iduser=Auth::user()->id;
		$idweb=DB::connection('pgsql_pag')->table('userportales')->where('iduser',$iduser)->value('iddirecciones_web');
        $dnweb=DB::connection('pgsql_pag')->table('direcciones_web')->where('iddirecciones_web',$idweb)->value('dns_direcciones_web');
		//$idweb = $accesoweb[0]->iddirecciones_web;

        $regvisita=DB::connection('pgsql_pag')->table('regvisita')->where('iddirecciones_web',$idweb)->orderBy('idregvisita','DESC')->paginate(10);
        return view('reportevisit',compact('regvisita','dnweb'));
    }
    public function reportevisitas(Request $request)
    {
        $request->validate(['fecha1'=>'required','fecha2'=>'required']);
        $from = date('Y-m-d H:i:s',strtotime($request->fecha1));
        $to = date('Y-m-d H:i:s',strtotime($request->fecha2));
        $iduser=Auth::user()->id;
		$idweb=DB::connection('pgsql_pag')->table('userportales')->where('iduser',$iduser)->value('iddirecciones_web');
        $consulta=DB::connection('pgsql_pag')->table('regvisita')->where('iddirecciones_web',$idweb)->whereBetween('fechaingreso',[$from, $to])->get();
        //DB::connection('pgsql_pag')->insert('insert into regvisita (id, name) values (?, ?)', [1, 'Dayle']);
        //return $consulta;

        $pdf=\PDF::loadView ('pdfreportevisita',compact('consulta'));
        return $pdf->stream();

    }
}
