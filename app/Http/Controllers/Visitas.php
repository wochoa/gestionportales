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
        $url='http://app.regionhuanuco.gob.pe/soap_pruebas/reniec.php?cdni='.$id;

        $wsdl = file_get_contents($url);
        return $wsdl;
    }

    public function reportevisit()
    {
        $iduser=Auth::user()->id;
		$idweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->value('iddirecciones_web');
        $dnweb=DB::connection('mysql')->table('direcciones_web')->where('iddirecciones_web',$idweb)->value('dns_direcciones_web');
		//$idweb = $accesoweb[0]->iddirecciones_web;

        $regvisita=DB::connection('mysql')->table('regvisita')->where('iddirecciones_web',$idweb)->orderBy('idregvisita','DESC')->paginate(10);
        return view('reportevisit',compact('regvisita','dnweb'));
    }
}
