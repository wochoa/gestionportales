<?php

// function activo($ruta)
// {
// 	return request()->routeIs($ruta) ? 'active' : '';
// }
// function menuopen()
// {
// 	$nombre=request()->path();
// 	switch ($nombre) {
// 		// esta seccion estara para menus Administrador
// 		case 'registropagina':$open='menu-open';break;
// 		case 'registrousuarios':$open='menu-open';break;

// 		// esta seccion estara para menus portal web
// 		case 'publicacion':$open='menu-open';break;
		
// 		default:
// 			$open='';
// 			break;
// 	}
// 	return $open;
// }
// function menuprincipal()
// {
// 	$nombre=request()->path();
// 	switch ($nombre) {
// 		// esta seccion estara para menus Administrador
// 		case 'registropagina':$open='active';break; 
// 		case 'registrousuarios':$open='active';break;


// 		// esta seccion estara para menus portal web
// 		case 'publicacion':$open='active';break;
		
// 		default:
// 			$open='';
// 			break;
// 	}
// 	return $open;
// }

function acceso($rol)
{
	switch($rol)
	{
		case 1: $acces="plantillas.supermenu";//administrador
		break;
		case 2: $acces="plantillas.administrador";//administrador
		break;
		case 3: $acces="plantillas.publicador";//administrador
		break;
		case 4: $acces="plantillas.atencionciudadno";//administrador
		break;
		case 5: $acces="plantillas.pide";//administrador
		break;
		case 6: $acces="plantillas.visitas";//administrador
		break;
	}
	return $acces;
}

function activo($ruta)
{
	return request()->routeIs($ruta) ? 'active' : '';
}
function menuopen($ruta=[])
{
	return request()->routeIs($ruta) ? 'menu-open' : '';
}

function tituloactivo($ruta=[])
{
	return request()->routeIs($ruta) ? 'active' : '';
}

function getRemoteFile($url, $timeout = 10) {
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$file_contents = curl_exec($ch);
	curl_close($ch);
	return ($file_contents) ? $file_contents : FALSE;
  }

  function convert_to_utf8_recursively($dat){
    if( is_string($dat) ){
        return mb_convert_encoding($dat, 'UTF-8', 'UTF-8');
    }
    elseif( is_array($dat) ){
        $ret = [];
        foreach($dat as $i => $d){
            $ret[$i] = convert_to_utf8_recursively($d);
        }
        return $ret;
    }
    else{
        return $dat;
    }
}