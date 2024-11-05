<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class Externopagina extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listadrw=DB::connection('pgsql_pag')->table('direcciones_web')->whereNotNull('dns_direcciones_web')->get();
        
        return view('listadirweb',compact('listadrw'));
        
    }
    public function listado_extrenovisitas($id)
    {
        // $request->validate(['fecha1'=>'required','fecha2'=>'required']);
        // $from = date('Y-m-d H:i:s',strtotime($request->fecha1));
        // $to = date('Y-m-d H:i:s',strtotime($request->fecha2));
        // $iduser=Auth::user()->id;
		// $idweb=DB::connection('pgsql_pag')->table('userportales')->where('iduser',$iduser)->value('iddirecciones_web');
        // $consulta=DB::connection('pgsql_pag')->table('regvisita')->where('iddirecciones_web',$idweb)->whereBetween('fechaingreso',[$from, $to])->get();
        // //DB::connection('pgsql_pag')->insert('insert into regvisita (id, name) values (?, ?)', [1, 'Dayle']);
        // //return $consulta;

        // $pdf=\PDF::loadView ('pdfreportevisita',compact('consulta'));
        // return $pdf->stream();
        $nombredireccion=DB::connection('pgsql_pag')->table('direcciones_web')->where('iddirecciones_web',$id)->value('nom_direcciones_web');

        //$consulta=DB::connection('pgsql_pag')->table('regvisita')->where('iddirecciones_web',$id)->paginate(10);
        return view('listadovisitexterno',compact('id','nombredireccion'));
    }

    public static function convert_from_latin1_to_utf8_recursively($dat)
   {
      if (is_string($dat)) {
         return utf8_encode($dat);
      } elseif (is_array($dat)) {
         $ret = [];
         foreach ($dat as $i => $d) $ret[ $i ] = self::convert_from_latin1_to_utf8_recursively($d);

         return $ret;
      } elseif (is_object($dat)) {
         foreach ($dat as $i => $d) $dat->$i = self::convert_from_latin1_to_utf8_recursively($d);

         return $dat;
      } else {
         return $dat;
      }
   }

    
}
