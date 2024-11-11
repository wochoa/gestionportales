<?php

namespace App\Http\Controllers;

use App\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('pgsql_pag')->table('userportales')->where('iduser',$iduser)->orderBy('id','DESC')->get();
		$idweb = $accesoweb[0]->iddirecciones_web;

		$videos=DB::connection('pgsql_pag')->table('videos')->where('iddirecciones_web',$idweb)->orderBy('id','DESC')->paginate(10);
		
		return view('videos',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addregvideos(Request $request)
    {
        $datos=$request->all();
		// $iddirweb=$datos["iddirweb"];

		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('pgsql_pag')->table('userportales')->where('iduser',$iduser)->get();
		$iddirweb = $accesoweb[0]->iddirecciones_web;

		$entidad=$datos["titulo"];
		$url=$datos["url"];
		$fecha=date('Y-m-d H:i:s');

		DB::connection('pgsql_pag')->insert('insert into videos (titulo,url,iddirecciones_web,created_at) values (?, ?,?,?)', [$entidad,$url,$iddirweb,$fecha]);

		
		session()->flash('newvideos', 'Fue agregado el videos de youtube tituloado :'.$entidad);
		return back()->withInput();

    }

    public function desactivavideos($id)
	{
		$sql="UPDATE videos SET estado=0 WHERE id=$id";
		DB::connection('pgsql_pag')->update($sql);

		session()->flash('desactivavideos', 'Fue desactivado el video con exito');
		return back()->withInput();
	}
	public function activavideos ($id)
	{
		$sql="UPDATE videos SET estado=1 WHERE id=$id";
		DB::connection('pgsql_pag')->update($sql);

		session()->flash('activavideos', 'Fue activado el con exito');
		return back()->withInput();
	}

    public function elimnavideos($id)
	{
		$sql="DELETE FROM videos WHERE id=$id";
		DB::connection('pgsql_pag')->update($sql);
		session()->flash('elimnavideos', 'Fue eliminado el video con exito');
		return back()->withInput();
	}

    public function datovideo($id)
	{
		$datos=DB::connection('pgsql_pag')->table('videos')->where('id',$id)->get();
		return $datos;
	}
	public function editvideo(Request $request)
	{
		$datos=$request->all();

		$id=$datos["id"];
		$titulo=$datos["titulop"];
		$url=$datos["urlp"];
	
		$sql="UPDATE videos set titulo='$titulo', url='$url' where id=$id";

		DB::connection('pgsql_pag')->update($sql);

		session()->flash('updatevideo', 'Fue actualizado el video');
		return back()->withInput();
	}

    /**
     * Display the specified resource.
     *
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function show(Videos $videos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function edit(Videos $videos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Videos $videos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Videos $videos)
    {
        //
    }
}
