<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortalApiController;

/* 
|--------------------------------------------------------------------------
| API Routes - Sistema de Gestion de Portales Multi-Tenant
|--------------------------------------------------------------------------
*/

// 1. Tema e Identificacion
Route::get('/tema', [PortalApiController::class, 'tema'])->name('tema');
Route::get('/portal/identificar', [PortalApiController::class, 'identificar'])->name('portal.identificar');

// 2. Menus y Navegacion
Route::get('/menus', [PortalApiController::class, 'menus'])->name('menus');

// 3. Convocatorias CAS
Route::get('/convocatorias', [PortalApiController::class, 'convocatorias'])->name('convocatorias');

// 4. Noticias y Prensa
Route::get('/noticiasini', [PortalApiController::class, 'noticiasini'])->name('noticiasini');
Route::get('/allnoticias', [PortalApiController::class, 'allnoticias'])->name('allnoticias');
Route::get('/noticias', [PortalApiController::class, 'allnoticias'])->name('noticias');
Route::get('/noticias/{id}', [PortalApiController::class, 'detnoticias'])->name('detnoticias');

// 5. Videos Institucionales
Route::get('/videosini', [PortalApiController::class, 'videosini'])->name('videosini');

// 6. Paginas, Secciones y Enlaces
Route::get('/pagina/{id}', [PortalApiController::class, 'pagina'])->name('pagina');
Route::get('/secciones', [PortalApiController::class, 'secciones'])->name('secciones');
Route::get('/enlace_refe', [PortalApiController::class, 'enlacerefe'])->name('enlacerefe');
Route::get('/gesambiental', [PortalApiController::class, 'gesambiental'])->name('gesambiental');

// 7. Visitas Institucionales
Route::get('/visitas', [PortalApiController::class, 'visitas'])->name('visitas');
Route::get('/buscarvisita/{bus}', [PortalApiController::class, 'buscarvisita'])->name('buscarvisita');

// 8. Popups y Alertas
Route::get('/listapopup', [PortalApiController::class, 'listapopup'])->name('listapopup');

// 9. Normatividad y Regulaciones
Route::get('/tipodoc', [PortalApiController::class, 'tipodoc'])->name('tipodoc');
Route::get('/regulations', [PortalApiController::class, 'regulations'])->name('regulations');
Route::get('/process-regulations/{codigo}', [PortalApiController::class, 'processRegulations'])->name('process-regulations');

// 10. Directorio y Unidades
Route::get('/directorio/{dir?}', [PortalApiController::class, 'directorio'])->name('directorio');
Route::get('/unidad/{cod?}', [PortalApiController::class, 'unidad'])->name('unidad');
Route::get('/organigrama', [PortalApiController::class, 'organigrama'])->name('organigrama');
Route::get('/fag', [PortalApiController::class, 'fag'])->name('fag');

// 11. Sliders de Portada
Route::get('/slider', [PortalApiController::class, 'slider'])->name('slider');
