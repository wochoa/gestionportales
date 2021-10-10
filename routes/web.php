<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('storage/notas-prensa/{file}', function ($file) {

	$rutaDeArchivo = storage_path() . '/app/public/notas-prensa/' . $file;
	//return $rutaDeArchivo;
	return response()->file($rutaDeArchivo);
});
Route::get('storage/avatar/{file}', function ($file) {

	$rutaDeArchivo = storage_path() . '/app/avatar/' . $file;
	//return $rutaDeArchivo;
	return response()->file($rutaDeArchivo);
});

Route::get('storage/enlaceref/{file}', function ($file) {

	$rutaDeArchivo = storage_path() . '/app/public/enlaceref/' . $file;
	//return $rutaDeArchivo;
	return response()->file($rutaDeArchivo);
});

// Route::get('storage/avatar/{file}', function ($file) {

// 	$rutaDeArchivo = storage_path() . '/app/public/avatar/' . $file;
// 	//return $rutaDeArchivo;
// 	return response()->file($rutaDeArchivo);
// });

Route::get('storage/logos/{file}', function ($file) {

	$rutaDeArchivo = storage_path() . '/app/public/logos/' . $file;
	//return $rutaDeArchivo;
	return response()->file($rutaDeArchivo);
});
Route::get('storage/popup/{file}', function ($file) {

	$rutaDeArchivo = storage_path() . '/app/public/popup/' . $file;
	//return $rutaDeArchivo;
	return response()->file($rutaDeArchivo);
});
Route::get('storage/slider/{file}', function ($file) {

	$rutaDeArchivo = storage_path() . '/app/public/slider/' . $file;
	//return $rutaDeArchivo;
	return response()->file($rutaDeArchivo);
});
Route::get('storage/seccion/{file}', function ($file) {

	$rutaDeArchivo = storage_path() . '/app/public/seccion/' . $file;
	//return $rutaDeArchivo;
	return response()->file($rutaDeArchivo);
});

Route::get('storage/{file}', function ($file) {

	$rutaDeArchivo = storage_path() . '/app/public/' . $file;
	//return $rutaDeArchivo;
	return response()->file($rutaDeArchivo);
});

Route::get('/', 'HomeController@index')->name('main');

Route::get('/register', function () {
    return redirect('/');
});

Route::get('/password/reset', function () {
    return redirect('/');
});
//Route::view('/login','auth.login')->name('login');
Route::view('/recuperacion', 'recuperacion')->name('recuperacion');
Route::view('/registrauser', 'registrauser')->name('registrauser');

Route::get('/datosuser/{id}', 'Contentgral@datosuser')->name('datosuser');
Route::post('/formeditusuario', 'Contentgral@formeditusuario')->name('formeditusuario');
route::get('/eliminauser/{id}','Contentgral@eliminauser')->name('eliminauser');
route::post('/formnewuser','Contentgral@formnewuser')->name('formnewuser');

route::get('/compruebacorreo/{id}','Contentgral@compruebacorreo')->name('compruebacorreo');
route::get('/compruebausuario/{id}','Contentgral@compruebausuario')->name('compruebausuario');
// acceso a main
//Route::view('/main','main')->name('main');

Route::get('/portalweb/publicacion', 'Contentgral@publicacion')->name('publicacion');
Route::get('/portalweb/newpublicaciones', 'Contentgral@newpublicaciones')->name('newpublicaciones');// ver formulario para nueva publicacion
Route::post('/formnewpublicaciones', 'Contentgral@formnewpublicaciones')->name('formnewpublicaciones');// guardar nueva publicacion
route::get('/desactivapubli/{id}','Contentgral@desactivapubli')->name('desactivapubli'); 
route::get('/activapubli/{id}','Contentgral@activapubli')->name('activapubli');


// rutas para menus
Route::get('/portalweb/menus', 'Contentgral@menus')->name('menus');
route::post('/formregmenu','Contentgral@formregmenu')->name('formregmenu');
route::get('/activarmp/{id}','Contentgral@activarmp')->name('activarmp');
route::get('/desactivarmp/{id}','Contentgral@desactivarmp')->name('desactivarmp');

route::get('/datoeditarmenu/{id}','Contentgral@datoeditarmenu')->name('datoeditarmenu');
route::post('/formregmenuedit','Contentgral@formregmenuedit')->name('formregmenuedit');

// rutas para sub menu

route::post('/formregsubmenu','Contentgral@formregsubmenu')->name('formregsubmenu');
route::get('/activarmpsub/{id}','Contentgral@activarmpsub')->name('activarmpsub');
route::get('/desactivarmpsub/{id}','Contentgral@desactivarmpsub')->name('desactivarmpsub');

route::get('/datoeditarsubmenu/{id}','Contentgral@datoeditarsubmenu')->name('datoeditarsubmenu');
route::post('/formregsubmenuedit','Contentgral@formregsubmenuedit')->name('formregsubmenuedit');
// rutas para pagina
Route::get('/portalweb/modulopagina', 'Contentgral@modulopagina')->name('modulopagina');

route::get('portalweb/verpagina/{id}','Contentgral@verpagina')->name('verpagina');
route::get('portalweb/newpagina','Contentgral@newpagina')->name('newpagina');
route::post('/formnewpagina','Contentgral@formnewpagina')->name('formnewpagina');
route::get('portalweb/editarpag/{id}','Contentgral@editarpag')->name('editarpag');
Route::post('/updatepagina','Contentgral@updatepagina')->name('updatepagina');//portalweb/eliminarpag/68
route::get('portalweb/eliminarpag/{id}','Contentgral@eliminarpag')->name('eliminarpag');

// categoria
route::get('/portalweb/categoria','Contentgral@categoria')->name('categoria');
route::post('/addregcategoria','Contentgral@addregcategoria')->name('addregcategoria');

// TAGS
route::get('/portalweb/tags','Contentgral@tags')->name('tags');
route::post('/addregtags','Contentgral@addregtags')->name('addregtags');

// popup
route::get('/portalweb/popup','Contentgral@popup')->name('popup');
route::post('/addrregpopup','Contentgral@addrregpopup')->name('addrregpopup');
route::get('/desactivapopup/{id}','Contentgral@desactivapopup')->name('desactivapopup');
route::get('/activapopup/{id}','Contentgral@activapopup')->name('activapopup');
route::post('/editpopup','Contentgral@editpopup')->name('editpopup');
route::get('/datopopup/{id}','Contentgral@datopopup')->name('datopopup');

// Slider
route::get('/portalweb/slider','Contentgral@slider')->name('slider');
route::post('/addrregslider','Contentgral@addrregslider')->name('addrregslider');
route::get('/desactivaslider/{id}','Contentgral@desactivaslider')->name('desactivaslider');
route::get('/activaslider/{id}','Contentgral@activaslider')->name('activaslider');
route::post('/editslider','Contentgral@editslider')->name('editslider');
route::get('/datoslider/{id}','Contentgral@datoslider')->name('datoslider');

// seccion pagina principal
route::get('/portalweb/seccion','Contentgral@seccion')->name('seccion');
route::post('/addregseccion','Contentgral@addregseccion')->name('addregseccion');
route::get('/desactivaseccion/{id}','Contentgral@desactivaseccion')->name('desactivaseccion');
route::get('/activaseccion/{id}','Contentgral@activaseccion')->name('activaseccion');
route::get('/elimnaseccion/{id}','Contentgral@elimnaseccion')->name('elimnaseccion');
route::get('/editasecciones/{id}','Contentgral@editasecciones')->name('editasecciones');
route::post('/updregseccion','Contentgral@updregseccion')->name('updregseccion');

// configuracion tema
route::get('/portalweb/tema','Contentgral@tema')->name('tema');
route::post('/addtema','Contentgral@addtema')->name('addtema');
route::post('/formedittema','Contentgral@formedittema')->name('formedittema');

Route::get('/portalweb/{id}/ver', 'Contentgral@verpublicacion')->name('verpublicacion');
Route::get('/portalweb/{id}/editar', 'Contentgral@editarpublicacion')->name('editarpublicacion');
Route::get('/portalweb/{id}/eliminar', 'Contentgral@eliminarpublicacion')->name('eliminarpublicacion');

Route::post('/formeditapublicaciones','Contentgral@formeditapublicaciones')->name('formeditapublicaciones'); //guardar editar publicacion

// administracion
Route::get('/administrador/registropagina', 'Contentgral@registropagina')->name('registropagina');
Route::post('/formregistropagina', 'Contentgral@formregistropagina')->name('formregistropagina');
Route::get('/administrador/registrousuarios', 'Contentgral@registrousuarios')->name('registrousuarios');



// enlace referencial
route::get('/portalweb/enlaceref','Contentgral@enlaceref')->name('enlaceref');
route::post('/addregenlaceref','Contentgral@addregenlaceref')->name('addregenlaceref');
route::get('/desactivarefe/{id}','Contentgral@desactivarefe')->name('desactivarefe');
route::get('/activarefe/{id}','Contentgral@activarefe')->name('activarefe');
route::get('/elimnarefe/{id}','Contentgral@elimnarefe')->name('elimnarefe');

// enlace para reclamaciones
route::get('/reclamaciones','Contentgral@reclamaciones')->name('reclamaciones');

// PARA CONSULTAS A SGD DE /mesaparte, /informaticos y /directoresyjefes


route::get('/sgd/vermesapartes','sgdcontroller@vermesapartes')->name('vermesapartes');

route::get('/sgd/informaticos','sgdcontroller@informaticos')->name('informaticos');
route::get('/directoresyjefes','sgdcontroller@directoresyjefes')->name('directoresyjefes');

// no acceso a gestionportales
//route::get('/acceso','')->name('acceso');

// enlace de regvistas
route::get('/regvisitas','Visitas@index')->name('regvisitas');
route::get('/reportevisit','Visitas@reportevisit')->name('reportevisit');

route::get('/reniec/{dni}','Visitas@reniec')->name('reniec');
