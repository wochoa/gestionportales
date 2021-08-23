<?php

// namespace App\Http\Controllers;

// namespace App\Http\Controllers\Auth;

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Image;

use function GuzzleHttp\Promise\all;

class Contentgral extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function __construct() {
		//$this->middleware('auth')->only('create','store');// aqui protegemos solo create y store
		$this->middleware('auth')->except('index'); // aqui protegemos a todos excepto las
	}

	// formaulario para agregar nueva publicacion de notas de prensa
	public function formnewpublicaciones(Request $request) 
	{
		
		$datos = $request->all();

		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idpaginaweb = $accesoweb[0]->iddirecciones_web;

		//$imagen1 = $request->file('imagen1')->store('public/notas-prensa');
		//$filename = time() . '.' . $imagen1->getClientOriginalExtension();
		$imagen1 = $request->file('imagen1');
        $filename = $idpaginaweb.'-1-'.date('Ymd-His') . '.' . $imagen1->getClientOriginalExtension();
		Image::make($imagen1)->resize(720, 482)->save( storage_path() . '/app/public/notas-prensa/' . $filename,72);
		$imagen1="public/notas-prensa/".$filename;
		
		
		if($request->file('imagen2'))
		{	//$imagen2 = $request->file('imagen2')->store('public/notas-prensa');
			$imagen2 = $request->file('imagen2');
			$filename = $idpaginaweb.'-2-'.date('Ymd-His') . '.' . $imagen2->getClientOriginalExtension();
			Image::make($imagen2)->resize(720, 482)->save( storage_path() . '/app/public/notas-prensa/' . $filename,72);
			$imagen2="public/notas-prensa/".$filename;
		}
		else{$imagen2="";}
		
		if($request->file('imagen3'))
		{//$imagen3 = $request->file('imagen3')->store('public/notas-prensa');
			$imagen3 = $request->file('imagen3');
			$filename = $idpaginaweb.'-3-'.date('Ymd-His') . '.' . $imagen3->getClientOriginalExtension();
			Image::make($imagen3)->resize(720, 482)->save( storage_path() . '/app/public/notas-prensa/' . $filename,72);
			$imagen3="public/notas-prensa/".$filename;
		}
		else{$imagen3="";}
		

		
		$contenido = $datos["contenido"];
		$categoria = $datos["categoria"];

		//$fechaingresado = date_create($datos["fecha"]);

		//$fecha = date_format($datos["fecha"], "Y-m-d H:i:s"); // date("Y-m-d H:i:s", strtotime());
		$fecha = date('Y-m-d H:i:s');

		DB::connection('mysql')->insert('insert into noticias(titulo,contenido,img1,img2,img3,fechapubli,iddirecciones_web,idcategoria,iduser) values(?,?,?,?,?,?,?,?,?)', [$datos["publicacion"], $contenido, $imagen1, $imagen2, $imagen3, $fecha, $idpaginaweb,$categoria,$iduser]);

		//return $datos;
		session()->flash('newpublicacion', 'Fue creado nueva publicación');
		return redirect('/portalweb/publicacion');
	}

	public function newpublicaciones() 
	{	// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idpaginaweb = $accesoweb[0]->iddirecciones_web;

		$categoria = DB::connection('mysql')->table('categoria')->where('iddirecciones_web',$idpaginaweb)->OrderBy('nomcategoia', 'asc')->get();
		return view('newpublicaciones', compact('categoria'));
	}
	public function formeditapublicaciones(Request $request) {
		$datos = $request->all();
		// $idpaginaweb=auth()->user()->iddirecciones_web;
		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idpaginaweb = $accesoweb[0]->iddirecciones_web;

		$ima1 = $request->file('imagen1');
		$ima2 = $request->file('imagen2');
		$ima3 = $request->file('imagen3');

		$idnot = $datos['idnoticia'];
		$cont = $datos['contenido'];
		$titulo=$datos['publicacion'];

		$sql = "";

		if ($ima1 != '') {
			//$imagen1 = $request->file('imagen1')->store('public/notas-prensa');
			$imagen1 = $request->file('imagen1');
			$filename = $idpaginaweb.'-1-'.date('Ymd-His') . '.' . $imagen1->getClientOriginalExtension();
			Image::make($imagen1)->resize(720, 482)->save( storage_path() . '/app/public/notas-prensa/' . $filename,72);
			$imagen1="public/notas-prensa/".$filename;

			$sql .= " , img1='$imagen1'";}
		if ($ima2 != '') {
			//$imagen2 = $request->file('imagen2')->store('public/notas-prensa');
			$imagen2 = $request->file('imagen2');
			$filename = $idpaginaweb.'-2-'.date('Ymd-His') . '.' . $imagen2->getClientOriginalExtension();
			Image::make($imagen2)->resize(720, 482)->save( storage_path() . '/app/public/notas-prensa/' . $filename,72);
			$imagen2="public/notas-prensa/".$filename;

			$sql .= ", img2='$imagen2'";}
		if ($ima3 != '') {
			//$imagen3 = $request->file('imagen3')->store('public/notas-prensa');
			$imagen3 = $request->file('imagen3');
			$filename = $idpaginaweb.'-3-'.date('Ymd-His') . '.' . $imagen3->getClientOriginalExtension();
			Image::make($imagen3)->resize(720, 482)->save( storage_path() . '/app/public/notas-prensa/' . $filename,72);
			$imagen3="public/notas-prensa/".$filename;
			
			$sql .= ", img3='$imagen3'";}

		$sqlimagen = "UPDATE noticias SET titulo='$titulo', contenido='$cont' " . $sql . " WHERE idnoticias=$idnot";
		DB::connection('mysql')->UPDATE($sqlimagen);
		//echo $sqlimagen;

		session()->flash('success', 'Fue actualizado la publiación');
		return back()->withInput();

	}

	public function publicacion()
	{
		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idpaginaweb = $accesoweb[0]->iddirecciones_web;

		$datosnot = DB::connection('mysql')->table('noticias')->where('iddirecciones_web',$idpaginaweb)->OrderBy('idnoticias', 'desc')->paginate(10);
		return view('publicacion', compact('datosnot'));
	}

	public function verpublicacion($id) {
		$dato = DB::connection('mysql')->table('noticias')->where('idnoticias', $id)->get();
		return view('verpublicacion', compact('dato'));
	}

	public function editarpublicacion($id) {
		$dato = DB::connection('mysql')->table('noticias')->where('idnoticias', $id)->get();

		// $idweb=auth()->user()->iddirecciones_web;

		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idweb = $accesoweb[0]->iddirecciones_web;

		$categoria = DB::connection('mysql')->table('categoria')->where('iddirecciones_web',$idweb)->OrderBy('nomcategoia', 'asc')->get();

		return view('editarpublicacion', compact('dato','categoria'));
	}

	public function eliminarpublicacion($id)
	{
		$sql="DELETE FROM noticias where idnoticias=$id";
		DB::connection('mysql')->delete($sql);
		session()->flash('elimnadoreg', 'Fue eliminado la publiación');
		return back()->withInput();
	}

	public function menus() {
		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idweb = $accesoweb[0]->iddirecciones_web;

		$datospag = DB::connection('mysql')->table('pagina')->where('iddirecciones_web',$idweb)->OrderBy('id_pagina', 'desc')->get();
		$datosmenu = DB::connection('mysql')->table('menus')->where('iddirecciones_web',$idweb)->get();
		$datossubmenu = DB::connection('mysql')->table('submenu')->join('menus','submenu.idmenus','=','menus.idmenus')->where('iddirecciones_web',$idweb)->get();
		return view('menus',compact('datospag','datosmenu','datossubmenu'));
	}
	public function formregmenu(Request $request)
	{
		$datos=$request->all();
		
		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idweb = $accesoweb[0]->iddirecciones_web;

		$nombre=$datos["nomdireccion"];
		$tieneweb=$datos["tieneweb"];//si o no

		$enlacesi=$datos["enlacesi"];// #
		$idpagina=$datos["idpagina"];//4
		$url=$datos["url"];//https

		if($tieneweb=="SI")
		{
			$enlacesi="#";
			$idpagina="";
		}
		else
		{
			if($idpagina<>''){
				$idpagina=$datos["idpagina"];
				$enlacesi="";
			}
			else{
				$idpagina="";
				$enlacesi=$url;
			}
		}
		$fecha = date('Y-m-d H:i:s');
		DB::connection('mysql')->insert('insert into menus (nom_menu,link_menu,id_pagina,iddirecciones_web,created_at) values (?, ?,?,?,?)', [$nombre,$enlacesi,$idpagina,$idweb,$fecha]);


		session()->flash('newmenu', 'Fue creado un menú nuevo');
		return back()->withInput();
	}
	public function activarmp($id)
	{
		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idweb = $accesoweb[0]->iddirecciones_web;


		$sql="UPDATE menus SET activo_menu=1 WHERE (idmenus=$id and iddirecciones_web=$idweb)";
		DB::connection('mysql')->update($sql);
		session()->flash('activarmenu', 'Fue activado el menu');
		return back()->withInput();
	}
	public function desactivarmp($id)
	{
		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idweb = $accesoweb[0]->iddirecciones_web;

		$sql="UPDATE menus SET activo_menu=0 WHERE (idmenus=$id and iddirecciones_web=$idweb)";
		DB::connection('mysql')->update($sql);
		session()->flash('desactivarmenu', 'Fue desactivado el menu');
		return back()->withInput();
	}

	public function formregsubmenu(Request $request)
	{
		$datos=$request->all();
		$nombre=$datos["nomsubmenu"];
		$idmenu=$datos["idmenus"];
		$enlaceexterno=$datos["enlaceexterno"];
		$enlcaesiessi=$datos["enlcaesiessi"];
		$idpaginaparasub=$datos["idpaginaparasub"];

		if($enlaceexterno=="SI")
		{
			$enlacesi=$enlcaesiessi;
			$idpaginaparasub="";
		}
		else {
			$enlacesi="";
			$idpaginaparasub=$idpaginaparasub;
		}

		$fecha = date('Y-m-d H:i:s');
		DB::connection('mysql')->insert('insert into submenu (nom_submenu,link_submenu,idpagina,idmenus,created_at) values (?, ?,?,?,?)', [$nombre,$enlacesi,$idpaginaparasub,$idmenu,$fecha ]);

		session()->flash('newsubmenu', 'Fue creado nuevo sub menú');
		return back()->withInput();

		//return $datos;
	}
	public function activarmpsub($id)
	{

		$sql="UPDATE submenu SET activo_submenu=1 WHERE (idsubmenu=$id)";
		DB::connection('mysql')->update($sql);
		session()->flash('activarmenusub', 'Fue activado el submenu');
		return back()->withInput();
	}
	public function desactivarmpsub($id)
	{

		$sql="UPDATE submenu SET activo_submenu=0 WHERE (idsubmenu=$id)";
		DB::connection('mysql')->update($sql);
		session()->flash('desactivarmenusub', 'Fue desactivado el submenu');
		return back()->withInput();
	}

	public function datoeditarmenu($id)
	{
		$datos=DB::connection('mysql')->table('menus')->where('idmenus',$id)->get();
		return $datos;
	}
	public function formregmenuedit(Request $request)
	{
		$datos=$request->all();
		$idmenu=$datos["idmenuedit"];
		$nombre=$datos["editnommenu"];
		$tieneweb=$datos["contiensub"];//si o no

		$enlacesi=$datos["enlacesi"];// #
		$idpagina=$datos["idpaginaedit"];//4
		$url=$datos["urledit"];//https

		if($tieneweb=="SI")
		{
			$enlacesi="#";
			$idpagina="";
		}
		else
		{
			if($idpagina<>''){
				$idpagina=$idpagina;
				$enlacesi="";
			}
			else{
				$idpagina="";
				$enlacesi=$url;
			}
		}
		$fecha = date('Y-m-d H:i:s');

		$sql="UPDATE menus SET nom_menu='$nombre',link_menu='$enlacesi',id_pagina='$idpagina',updated_at='$fecha ' WHERE idmenus=$idmenu";
		
		DB::connection('mysql')->update($sql);

		session()->flash('updmenu', 'Fue actualizado el menu principal');
		return back()->withInput();

	}
	
	public function datoeditarsubmenu($id)
	{
		$datos=DB::connection('mysql')->table('submenu')->where('idsubmenu',$id)->get();
		return $datos;
	}
	public function formregsubmenuedit(Request $request)
	{
		$datos=$request->all();
		$idsubmenu=$datos["idsubmenuedit"];
		$nombre=$datos["nomsubmenuedit"];
		$idmenu=$datos["editidmenussub"];
		$enlaceexterno=$datos["enlaceexternoedit"];
		$enlcaesiessi=$datos["enlcaesiessiedit"];
		$idpaginaparasub=$datos["idpaginaparasubedit"];

		if($enlaceexterno=="SI")
		{
			$enlacesi=$enlcaesiessi;
			$idpaginaparasub="";
		}
		else {
			$enlacesi="";
			$idpaginaparasub=$idpaginaparasub;
		}

		$fecha = date('Y-m-d H:i:s');
		
		$sql="UPDATE submenu SET nom_submenu='$nombre',link_submenu='$enlacesi',idpagina='$idpaginaparasub',idmenus='$idmenu',updated_at='$fecha'  WHERE idsubmenu=$idsubmenu";
		
		DB::connection('mysql')->update($sql);
		session()->flash('editsubmenu', 'Fue actualizado el submenu');
		return back()->withInput();

		//return $datos;
	}

	public function modulopagina()
	{	
		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idweb = $accesoweb[0]->iddirecciones_web;

		$datospag = DB::connection('mysql')->table('pagina')->where('iddirecciones_web',$idweb)->OrderBy('id_pagina', 'desc')->paginate(10);

		$dirweb=DB::connection('mysql')->table('direcciones_web')->where('iddirecciones_web',$idweb)->get();
		$dirul=@$dirweb[0]->dns_direcciones_web;

		return view('modulopagina', compact('datospag','dirul'));
	}
	public function verpagina($id)
	{	
		$dato=DB::connection('mysql')->table('pagina')->where('id_pagina',$id)->get();
		return view('verpagina',compact('dato'));
	}
	public function updatepagina(Request $request)
	{
		$datos=$request->all();

		$id=$datos["idpagina"];
		$content=$datos["contenido"];
		$titulo=$datos["publicacion"];
		$sql="UPDATE pagina SET nom_pagina='$titulo',cont_pagina='$content' WHERE id_pagina=$id";
		DB::connection('mysql')->update($sql);

		session()->flash('success', 'Fue actualizado con exito');
		return back()->withInput();
		
	}
	public function desactivapubli($id)
	{
		$sql="UPDATE noticias SET activo=0 WHERE idnoticias=$id";
		DB::connection('mysql')->update($sql);

		session()->flash('desactivanot', 'Fue desactivado la publicaccion con exito');
		return back()->withInput();
	}
	
	public function activapubli($id)
	{
		$sql="UPDATE noticias SET activo=1 WHERE idnoticias=$id";
		DB::connection('mysql')->update($sql);

		session()->flash('activanot', 'Fue activado la publicaccion con exito');
		return back()->withInput();
	}

	public function categoria()
	{	$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idpaginaweb = $accesoweb[0]->iddirecciones_web;

		$datos=DB::connection('mysql')->table('categoria')->where('iddirecciones_web',$idpaginaweb)->get();
		return view('categoria',compact('datos'));
	}
	// agregramos la nueva categoria
	public function addregcategoria(Request $request)
	{
		$datos=$request->all();

		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idpaginaweb = $accesoweb[0]->iddirecciones_web;


		$fecha=date('Y-m-d H:i:s');
		$resultado=DB::connection('mysql')->insert('insert into categoria(nomcategoia,iddirecciones_web,created_at,updated_at)values(?,?,?,?)',[$datos['nomdireccion'],$idpaginaweb,$fecha,$fecha]);

		session()->flash('success', 'Fue agregado con exito');
		return back()->withInput();
	}

	public function tags()
	{
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idweb = $accesoweb[0]->iddirecciones_web;

		$datos=DB::connection('mysql')->table('tags')->where('iddirecciones_web',$idweb)->get();

		return view('tags',compact('datos'));
	}
	public function addregtags(Request $request)
	{
		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idweb = $accesoweb[0]->iddirecciones_web;

		$datos = $request->all();
		$fecha=date('Y-m-d H:i:s');
		DB::connection('mysql')->insert('insert into tags (nom_tags,iddirecciones_web,created_at) values (?, ?,?)', [$datos['nomtags'],$idweb,$fecha]);

		session()->flash('success', 'Fue agregado nueva ventana emergente');
		return back()->withInput();
	}
	
	public function popup()
	{	// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idweb = $accesoweb[0]->iddirecciones_web;

		$dato=DB::connection('mysql')->table('popup')->where('iddirecciones_web',$idweb)->get();
		return view('popup',compact('dato'));
	}
	public function addrregpopup(Request $request)
	{
		$datos = $request->all();
		
		$archivo = $request->file('imgpopup')->store('public/popup');

		// $iddirweb=$datos['iddirweb'];
		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$iddirweb = $accesoweb[0]->iddirecciones_web;

		$titulo=$datos['nombre'];
		$url=$datos['url'];
		$fecha = date('Y-m-d H:i:s');

		DB::connection('mysql')->insert('insert into popup (titulopopup,nompopup,enlace_popup,activogral,iddirecciones_web,created_at) values (?, ?,?,?,?,?)', [$titulo,$archivo,$url,1,$iddirweb,$fecha]);

		session()->flash('success', 'Fue agregado nueva ventana emergente');
		return back()->withInput();
		// return $archivo ;
	}
	public function desactivapopup($id)
	{
		$sql="UPDATE popup SET activogral=0 WHERE idpopup=$id";
		DB::connection('mysql')->update($sql);
		session()->flash('desactivapopup', 'Fue desactivado la publicación');
		return back()->withInput();
	}
	public function activapopup($id)
	{
		$sql="UPDATE popup SET activogral=1 WHERE idpopup=$id";
		DB::connection('mysql')->update($sql);
		session()->flash('activapopup', 'Fue activado la publicación');
		return back()->withInput();
	}
	public function datopopup($id)
	{
		$datos=DB::connection('mysql')->table('popup')->where('idpopup',$id)->get();
		return $datos;
	}
	public function editpopup(Request $request)
	{
		$datos=$request->all();

		if($request->file('imgpopupp'))
		{
			$archivo = $request->file('imgpopupp')->store('public/popup');
			$image=",nompopup='".$archivo."',";
		}
		else
		{
			$image='';
		}
		$titulo=$datos["nombrep"];
		$url=$datos["urlp"];
		$ippop=$datos["idpopup"];
		$sql="UPDATE popup set titulopopup='$titulo'".$image." enlace_popup='$url' where idpopup=$ippop";

		DB::connection('mysql')->update($sql);

		session()->flash('updatepopup', 'Fue actualizado el anuncio emergente');
		return back()->withInput();
	}
	public function seccion()
	{
		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idweb = $accesoweb[0]->iddirecciones_web;

		$dato=DB::connection('mysql')->table('secciones')->where('iddirecciones_web',$idweb)->orderBy('seccion_pag','asc')->get();
		return view('seccion',compact('dato'));
	}
	public function addregseccion(Request $request)
	{	
		$datos = $request->all();
		// $idweb=$datos['iddirweb'];
		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idweb = $accesoweb[0]->iddirecciones_web;

		$seccion=$datos['seccion'];
		$titulo=$datos['titulo'];
		$texto_enlace=$datos['texto_enlace'];
		$Url=$datos['Url'];
		$icono=$datos['icono'];
		$color=$datos['color'];
		$apartado=$datos['apartado'];
		$fecha=$datos['fecha'];
		$imagen = $request->file('imgseccion');
		if($imagen){$archivo = $request->file('imgseccion')->store('public/seccion');}
		else{$archivo="";}

		DB::connection('mysql')->insert('insert into secciones (titulo,texto_enlace,icono,color,enlace,apartado,archivo_imagen,seccion_pag,iddirecciones_web,created_at) values (?, ?,?,?,?,?,?,?,?,?)', [$titulo,$texto_enlace,$icono,$color,$Url,$apartado,$archivo,$seccion,$idweb,$fecha]);
		//return $datos;
		session()->flash('success', 'Fue agregado nueva ventana emergente');
		return back()->withInput();
	}

	public function desactivaseccion($id)
	{
		$sql="UPDATE secciones SET activo=0 WHERE idseccion=$id";
		DB::connection('mysql')->update($sql);

		session()->flash('desactivadoseccion', 'Fue desactivado la sección con exito');
		return back()->withInput();
	}

	public function activaseccion($id)
	{
		$sql="UPDATE secciones SET activo=1 WHERE idseccion=$id";
		DB::connection('mysql')->update($sql);

		session()->flash('activadoseccion', 'Fue activado la sección con exito');
		return back()->withInput();
	}
	public function elimnaseccion($id)
	{
		$sql="delete from secciones where idseccion=$id";
		DB::connection('mysql')->delete($sql);
		session()->flash('elimnaseccion', 'Fue eliminado la sección con exito');
		return back()->withInput();
	}

	public function editasecciones($id)
	{
		$datos=DB::connection('mysql')->table('secciones')->where('idseccion',$id)->get();
		return $datos;
	}
	public function updregseccion(Request $request)
	{
		$datos=$request->all();
		$id=$datos["idseccion"];
		$titulo=$datos["tituloe"];
		$text_enlace=$datos["texto_enlacee"];
		$url=$datos["Urle"];
		$icono=$datos["iconoe"];
		$color=$datos["colore"];
		$apartado=$datos["apartadoe"];
		$fecha = date('Y-m-d H:i:s');

		$imagen = $request->file('imgseccione');
		if($imagen){$archivo = $request->file('imgseccione')->store('public/seccion');
			$sql="UPDATE secciones SET titulo='$titulo',texto_enlace='$text_enlace',icono='$icono',color='$color',enlace='$url',updated_at='$fecha',apartado='$apartado',archivo_imagen='$archivo' WHERE idseccion=$id";
		}
		else{
			$sql="UPDATE secciones SET titulo='$titulo',texto_enlace='$text_enlace',icono='$icono',color='$color',enlace='$url',updated_at='$fecha',apartado='$apartado' WHERE idseccion=$id";
		}

		DB::connection('mysql')->update($sql);

		session()->flash('Actualizadosec', 'Fue actualizado la sección con exito');
		return back()->withInput();
	}

	public function newpagina()
	{
		return view('newpagina');
	}
	public function formnewpagina(Request $request)
	{
		$datos = $request->all();
		$idusers=auth()->user()->id;
		// $idwev=$datos["idweb"];

		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idwev = $accesoweb[0]->iddirecciones_web;
		
		$nompagina=$datos["nompagina"];
		$contenido=$datos["contenido"];
		$fecha2=$datos["fecha"];

		// $date = date_create($fecha2);
		// $fecha=date_format($date,"Y-m-d H:i:s");

		$fecha =date('Y-m-d H:i:s');

		DB::connection('mysql')->insert('insert into pagina (nom_pagina,cont_pagina,fecha_pag,iddirecciones_web,iduser) values (?, ?,?,?,?)', [$nompagina,$contenido,$fecha,$idwev,$idusers]);

		session()->flash('nuevapagina', 'Fue agregado nueva pagina');
		return back()->withInput();
		//return $datos;
	}

	public function editarpag($id)
	{
		$dato=DB::connection('mysql')->table('pagina')->where('id_pagina',$id)->get();

		 // ponemos la regla de permisos
		 if(Auth::user()->can('gp_pagina_editar'))
		 {
			 return view('editarpagina',compact('dato'));
		 }
		 else{
			 return view('noacceso');
			 // return redirect('/login');
		 }

		
	}
	public function eliminarpag($id)
	{
		$sql="DELETE from pagina WHERE id_pagina=".$id;
		// ponemos la regla de permisos
		if(Auth::user()->can('gp_pagina_editar'))
		{
			DB::connection('mysql')->delete($sql);
			session()->flash('eliminadopag', 'Fue Elimnado la página');
			return back()->withInput();
		}
		else{
			return view('noacceso');
			// return redirect('/login');
		}
	
	}

	public function registropagina() {
		$datos = DB::connection('mysql')->table('direcciones_web')->OrderBy('iddirecciones_web', 'desc')->paginate(15);

		$dependencia=DB::table('dependencia')->select('depe_depende')->where(['depe_estado'=>'1','depe_tipo'=>'1'])->groupBy('depe_depende')->orderBy('depe_depende','ASC')->get();
        
        for($i=0;$i<count($dependencia);$i++)
        {
                $nomdepe=DB::table('dependencia')->where('iddependencia',$dependencia[$i]->depe_depende)->get();

                if($dependencia[$i]->depe_depende<>1034 and $dependencia[$i]->depe_depende<>1818 and $dependencia[$i]->depe_depende<>851 and $dependencia[$i]->depe_depende<>1894)
                {$datosdepe[]=array("iddepe"=>$dependencia[$i]->depe_depende,"nombredebe"=>$nomdepe[0]->depe_nombre);}
               
        }

		return view('registropagina', compact('datos','datosdepe'));
	}

	public function formregistropagina(Request $request) {
		$datos = $request->all();
		DB::connection('mysql')->insert('insert into direcciones_web (nom_direcciones_web,linkdirecciones_web,dns_direcciones_web) values (?,?,?)', [$datos["nomdireccion"], $datos["dominioext"], $datos["dominiogore"]]);
		// return response()->json($datos);

		//return $datos;
		return redirect('/administrador/registrousuarios');
	}
	public function tema()
	{	
		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idweb = $accesoweb[0]->iddirecciones_web;

		$datos=DB::connection('mysql')->table('tema_portal')->where('iddirecciones_web',$idweb)->get();
		return view('tema',compact('datos'));
	}
	public function addtema(Request $request)
	{
		$datos=$request->all();
		// $idweb=$datos["iddirweb"];
		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idweb = $accesoweb[0]->iddirecciones_web;

		$nomtema=$datos["nomtema"];
		$colortema=$datos["colortema"];
		//$logo=$datos["logo"];//IMAGES
		$logo=$request->file('logo')->store('public/logos');
		$correoatencion=$datos["correoatencion"];
		$tel_atencion=$datos["tel_atencion"];
		$correocoporativo=$datos["correocoporativo"];
		$urltrasnpararencia=$datos["urltrasnpararencia"];
		$linkmesapartes=$datos["linkmesapartes"];
		$foote_1=$datos["foote_1"];
		$foote_2=$datos["foote_2"];
		$foote_3=$datos["foote_3"];
		$foote_4=$datos["foote_4"];
		$linkfacebook=$datos["linkfacebook"];
		$fecha=date('Y-m-d H:i:s');

		DB::connection('mysql')->insert('insert into tema_portal (nom_tema,color_tema,logo_tema,top_email,top_fono,top_correocorp,top_transparencia,top_mesapartesvirtual,footer_f1,footer_f2,footer_f3,redes_sociales,iddirecciones_web,created_at,linkpag_facebook) values (?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$nomtema,$colortema,$logo,$correoatencion,$tel_atencion,$correocoporativo,$urltrasnpararencia,$linkmesapartes,$foote_1,$foote_2,$foote_3,$foote_4,$idweb,$fecha,$linkfacebook]);

		session()->flash('newtema', 'Fue creado nuevo tema');
		return back()->withInput();

		//return $datos;
	}
	public function formedittema(Request $request)
	{   $datos=$request->all();
		$idtema=$datos["idtema"];
		// $idweb=$datos["iddirweb"];
		$nomtema=$datos["nomtema"];
		$colortema=$datos["colortema"];
		//$logo=$datos["logo"];//IMAGES
		$correoatencion=$datos["correoatencion"];
		$tel_atencion=$datos["tel_atencion"];
		$correocoporativo=$datos["correocoporativo"];
		$urltrasnpararencia=$datos["urltrasnpararencia"];
		$linkmesapartes=$datos["linkmesapartes"];
		$foote_1=$datos["foote_1"];
		$foote_2=$datos["foote_2"];
		$foote_3=$datos["foote_3"];
		$foote_4=$datos["foote_4"];
		$fecha=date('Y-m-d H:i:s');
		$linkfacebook=$datos["linkfacebook2"];

		if($request->file('logo')){$logo=$request->file('logo')->store('public/logos');			
			$paralogo=" logo_tema='$logo', ";			
		}
		else{
			$paralogo="";	
			}
		
		if($request->file('favicon')){$favicon=$request->file('favicon')->store('public/logos');			
			$parafavicon=" favicon='$favicon', ";			
		}
		else{
			$parafavicon="";	
			}

		$sql="update tema_portal set 
			nom_tema='$nomtema',
			color_tema='$colortema',
			top_email='$correoatencion',
			top_fono='$tel_atencion',
			".$paralogo.$parafavicon."
			top_correocorp='$correocoporativo',
			top_transparencia='$urltrasnpararencia',
			top_mesapartesvirtual='$linkmesapartes',
			footer_f1='$foote_1',
			footer_f2='$foote_2',
			footer_f3='$foote_3',
			redes_sociales='$foote_4',
			updated_at='$fecha',
			linkpag_facebook='$linkfacebook'  
			where id_tema=$idtema";


		
		
		DB::connection('mysql')->update($sql);
		

		session()->flash('updtema', 'El tema fue actualizado');
		return back()->withInput();

		//return $datos;

	}


	/// seccion para usuarios....
	public function formeditusuario(Request $request) {
		$datos = $request->all();
		$id = $datos["iduser"];
		if ($datos['pass'] != '') {
			$clave = Hash::make($datos['pass']);
			$sql = "UPDATE users SET password='" . $clave . "' WHERE id=" . $id;
			$resultado = DB::connection('mysql')->UPDATE($sql);
		}

		//return $datos;
		return redirect('/administrador/registrousuarios');
	}
	public function registrousuarios() {
		$datosuser = DB::connection('mysql')->table('userportales')->OrderBy('id', 'asc')->paginate(15);
		$roles=DB::connection('mysql')->table('roles')->get();
		$paginasweb=DB::connection('mysql')->table('direcciones_web')->get();
		return view('usuarios', compact('datosuser','roles','paginasweb'));
	}
	// para jalar datos en formato y pasarlo a ajax
	public function datosuser($id) {
		$databucado = DB::connection('mysql')->table('users')->where('id', $id)->get();
		return $databucado;
	}
	// para comprobar la existencia correos
	public function compruebacorreo($id)
	{
		$databucado = DB::connection('mysql')->table('users')->where('email',$id)->get();
		if(count($databucado)){
			$texto="Ya existe un correo similar";
		}
		else{$texto="El correo ingresado es nuevo";}
		return json_encode(array('email'=>$texto));
	}
	// para comprobar la existencia de username
	public function compruebausuario($id)
	{
		$databucado = DB::connection('mysql')->table('users')->where('username',$id)->get();
		if(count($databucado)){
			$texto="Ya existe el username similar";
		}
		else{$texto="El username ingresado es nuevo";}
		return json_encode(array('username'=>$texto));
	}
	public function formnewuser(Request $request)
	{
		$datos=$request->all();
		$nombres=$datos["nombres"];
		$email=$datos["email"];
		$dirweb=$datos["direweb"];
		$rol=$datos["rol"];
		$usuarionew=$datos["usuarionew"];
		$clave=Hash::make($datos["clave"]);
		$fecha=date('Y-m-d H:i:s');
		if($request->file('imagen')){$imagen=$request->file('imagen')->store('public/avatar');}
		else{$imagen="public/avatar/default.png";}
		

		DB::connection('mysql')->insert('insert into users (name,email,username,password,profile_pic,is_active,rol,iddirecciones_web,created_at,updated_at) values (?, ?,?,?,?,?,?,?,?,?)', [$nombres,$email,$usuarionew,$clave,$imagen,1,$rol,$dirweb,$fecha,$fecha]);

		session()->flash('newuser', 'Fue creado nuevo usuario');
		return back()->withInput();
		//return $datos;
	}
	public function eliminauser($id)
	{
		$sql="DELETE FROM users where id=".$id;
		DB::connection('mysql')->delete($sql);
		session()->flash('danger', 'Fue eliminado el usuario');
		return back()->withInput();
	}
// fin de usuarios	
	

	public function enlaceref()
	{	// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$idweb = $accesoweb[0]->iddirecciones_web;

		$enlaceref=DB::connection('mysql')->table('enlacerefe')->where('iddirecciones_web',$idweb)->paginate(10);
		
		return view('enlaceref',compact('enlaceref'));
	}
	public function addregenlaceref(Request $request)
	{
		$datos=$request->all();
		// $iddirweb=$datos["iddirweb"];

		// consultamos a BD para saber el el usuario tiene acceso para crear publicaccion respectivamente con el id de pagina creada
		$iduser=Auth::user()->id;
		$accesoweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->get();
		$iddirweb = $accesoweb[0]->iddirecciones_web;

		$entidad=$datos["entidad"];
		$url=$datos["url"];
		$fecha=date('Y-m-d H:i:s');

		$imagen=$request->file('imagen')->store('public/enlaceref');

		DB::connection('mysql')->insert('insert into enlacerefe (img_refe,link_refe,iddirecciones_web,created_at,entidad_ref) values (?, ?,?,?,?)', [$imagen,$url,$iddirweb,$fecha,$entidad]);

		
		session()->flash('newenlaceref', 'Fue creado el enlace referencial :'.$entidad);
		return back()->withInput();
	}

	public function desactivarefe($id)
	{
		$sql="UPDATE enlacerefe SET activo_refe=0 WHERE idenlacerefe=$id";
		DB::connection('mysql')->update($sql);

		session()->flash('desactivarefe', 'Fue desactivado la referencia con exito');
		return back()->withInput();
	}
	public function activarefe ($id)
	{
		$sql="UPDATE enlacerefe SET activo_refe=1 WHERE idenlacerefe=$id";
		DB::connection('mysql')->update($sql);

		session()->flash('activarefe', 'Fue activado la referencia con exito');
		return back()->withInput();
	}

	public function elimnarefe($id)
	{
		$sql="DELETE FROM enlacerefe WHERE idenlacerefe=$id";
		DB::connection('mysql')->update($sql);
		session()->flash('eliminadoref', 'Fue eliminado la referencia con exito');
		return back()->withInput();
	}

	
	

	
}
