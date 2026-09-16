<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Exception;
use App\Menu;
use App\Submenu;
use App\Pagina;

class PortalApiController extends Controller
{
    protected $connection = 'pgsql_pag';

    protected function db()
    {
        return DB::connection($this->connection);
    }

    /**
     * Limpia el prefijo 'public/' de cualquier ruta de imagen o archivo
     */
    private function cleanImagePath($path)
    {
        if (empty($path)) {
            return '';
        }
        $p = trim((string) $path);
        if (strpos($p, 'public/') === 0) {
            $p = substr($p, 7);
        } elseif (strpos($p, 'public\\') === 0) {
            $p = substr($p, 7);
        }
        return ltrim($p, '/\\');
    }

    /**
     * Resuelve el iddirecciones_web a partir del request o del encabezado/parámetro de dominio.
     */
    protected function resolveIdDireccion(Request $request)
    {
        if ($request->filled('iddirecciones_web')) {
            return (int) $request->iddirecciones_web;
        }

        $domain = $request->header('X-Portal-Domain') ?: $request->get('domain');
        if (!empty($domain)) {
            $cleanDomain = rtrim($domain, '/');
            $web = $this->db()->table('direcciones_web')
                ->where('dns_direcciones_web', 'ILIKE', "%{$cleanDomain}%")
                ->first();
            if ($web) {
                return (int) $web->iddirecciones_web;
            }
        }

        return 11;
    }

    /**
     * 1. Tema y Configuracion del Portal
     */
    public function tema(Request $request)
    {
        $idDireccion = $this->resolveIdDireccion($request);

        try {
            $tema = $this->db()->table('tema_portal')->where('iddirecciones_web', $idDireccion)->first();
            $portalesweb = $this->db()->table('direcciones_web')->where('iddirecciones_web', $idDireccion)->first();

            $nombredireccionweb = $portalesweb ? $portalesweb->nom_direcciones_web : 'GOBIERNO REGIONAL HUANUCO';

            $temas = [
                'iddirecciones_web' => $idDireccion,
                'iddependencias' => $request->iddependencias ?? 3,
                'tmcolor_tema' => $tema->color_tema ?? '#044D34',
                'tmlogo_tema' => $this->cleanImagePath($tema->logo_tema ?? ''),
                'raw_tmlogo_tema' => $tema->logo_tema ?? '',
                'tmtop_email' => $tema->top_email ?? 'contacto@regionhuanuco.gob.pe',
                'tmtop_fono' => $tema->top_fono ?? '(062) 512 124',
                'tmtop_correocorp' => $tema->top_correocorp ?? '',
                'tmtop_transparencia' => $tema->top_transparencia ?? '',
                'tmtop_mesapartesvirtual' => $tema->top_mesapartesvirtual ?? '',
                'tmfooter_f1' => $tema->footer_f1 ?? '',
                'tmfooter_f2' => $tema->footer_f2 ?? '',
                'tmfooter_f3' => $tema->footer_f3 ?? '',
                'tmredes_sociales' => $tema->redes_sociales ?? '',
                'tmredes_linkface' => $tema->linkpag_facebook ?? '',
                'favicons' => $this->cleanImagePath($tema->favicon ?? ''),
                'nombredireccionweb' => $nombredireccionweb,
                'dnsserver' => env('URL_TEMA', ''),
                'registro_web' => $portalesweb
            ];

            return response()->json(['tema' => $temas], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * 2. Identificar (Alias unificado para Vue 3)
     */
    public function identificar(Request $request)
    {
        return $this->tema($request);
    }

    /**
     * 3. Menus y Submenus Dinamicos
     */
    public function menus(Request $request)
    {
        $idDireccion = $this->resolveIdDireccion($request);

        try {
            $menus = $this->db()->table('menus')
                ->where('iddirecciones_web', $idDireccion)
                ->where('activo_menu', 1)
                ->orderBy('idmenus', 'ASC')
                ->get();

            $datsubmenu = $this->db()->table('submenu')
                ->join('menus', 'submenu.idmenus', '=', 'menus.idmenus')
                ->where('menus.iddirecciones_web', $idDireccion)
                ->where('menus.activo_menu', 1)
                ->where('submenu.activo_submenu', 1)
                ->select(
                    'submenu.idsubmenu',
                    'submenu.nom_submenu',
                    'submenu.link_submenu',
                    'submenu.archivo',
                    'submenu.idpagina',
                    'submenu.ico_submenu',
                    'submenu.idmenus'
                )
                ->orderBy('submenu.idmenus', 'ASC')
                ->orderBy('submenu.idsubmenu', 'ASC')
                ->get();

            return response()->json([
                'menus' => $menus,
                'submenus' => $datsubmenu
            ], 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Cache-Control' => 'no-cache, no-store, must-revalidate'
            ], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['menus' => [], 'submenus' => []], 200);
        }
    }

    /**
     * 4. Noticias de Inicio (noticiasini - 8 ultimas)
     */
    public function noticiasini(Request $request)
    {
        $idDireccion = $request->iddirecciones_web ?? 11;

        try {
            $publicacion = $this->db()->table('noticias')
                ->where('activo', 1)
                ->where('iddirecciones_web', $idDireccion)
                ->orderBy('idnoticias', 'DESC')
                ->limit(8)
                ->get();

            $datos = [];
            foreach ($publicacion as $item) {
                $imagen = $this->cleanImagePath($item->img1);
                $titulo = html_entity_decode($item->titulo ?? '');
                $datos[] = [
                    'idnoticias' => $item->idnoticias,
                    'titulo' => $titulo,
                    'img1' => $imagen,
                    'raw_img1' => $item->img1,
                    'fecha' => $item->fechapubli ?? $item->created_at,
                    'contenido' => $item->contenido ?? ''
                ];
            }

            return response()->json(['listanoticias' => $datos, 'data' => $datos], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['listanoticias' => [], 'data' => []], 200);
        }
    }

    /**
     * 5. Todas las Noticias Paginadas (allnoticias y /noticias)
     */
    public function allnoticias(Request $request)
    {
        $idDireccion = $request->iddirecciones_web ?? 11;
        $limit = (int) $request->get('limit', $request->get('paginate', 10));
        $search = $request->get('search', $request->get('bus', ''));

        try {
            $query = $this->db()->table('noticias')
                ->where('activo', 1)
                ->where('iddirecciones_web', $idDireccion);

            if (!empty($search)) {
                $query->where('titulo', 'ILIKE', '%' . $search . '%');
            }

            $publicacion = $query->orderBy('idnoticias', 'DESC')->paginate($limit);

            $items = collect($publicacion->items())->map(function ($item) {
                $obj = (array) $item;
                $obj['img1'] = $this->cleanImagePath($obj['img1'] ?? '');
                $obj['img2'] = $this->cleanImagePath($obj['img2'] ?? '');
                $obj['img3'] = $this->cleanImagePath($obj['img3'] ?? '');
                $obj['raw_img1'] = $item->img1 ?? '';
                $obj['raw_img2'] = $item->img2 ?? '';
                $obj['raw_img3'] = $item->img3 ?? '';
                return $obj;
            })->all();

            return response()->json([
                'listanoticias' => $publicacion,
                'data' => $items,
                'total' => $publicacion->total(),
                'current_page' => $publicacion->currentPage(),
                'last_page' => $publicacion->lastPage()
            ], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['listanoticias' => [], 'data' => []], 200);
        }
    }

    /**
     * 6. Detalle de Noticia
     */
    public function detnoticias(Request $request, $id)
    {
        $idDireccion = $request->iddirecciones_web ?? 11;

        try {
            $publicacion = $this->db()->table('noticias')
                ->where('activo', 1)
                ->where('iddirecciones_web', $idDireccion)
                ->where('idnoticias', $id)
                ->first();

            if (!$publicacion) {
                return response()->json(['detallenot' => [], 'message' => 'Noticia no encontrada'], 404);
            }

            $imagen1 = $this->cleanImagePath($publicacion->img1);
            $imagen2 = $this->cleanImagePath($publicacion->img2);
            $imagen3 = $this->cleanImagePath($publicacion->img3);

            $datos = [[
                'idnoticias' => $publicacion->idnoticias,
                'titulo' => html_entity_decode($publicacion->titulo ?? ''),
                'contenido' => $publicacion->contenido ?? '',
                'img1' => $imagen1,
                'img2' => $imagen2,
                'img3' => $imagen3,
                'raw_img1' => $publicacion->img1,
                'raw_img2' => $publicacion->img2,
                'raw_img3' => $publicacion->img3,
                'fecha' => $publicacion->fechapubli ?? $publicacion->created_at
            ]];

            return response()->json(['detallenot' => $datos, 'data' => $datos[0]], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['detallenot' => []], 500);
        }
    }

    /**
     * 7. Convocatorias CAS
     */
    public function convocatorias(Request $request)
    {
        $idDireccion = $this->resolveIdDireccion($request);

        try {
            $query = $this->db()->table('cas_proceso_seleccion')
                ->where('iddireccionweb', $idDireccion)
                ->where('cas_proc_sel_estado', 1);

            if ($request->filled('year') || $request->filled('anio')) {
                $year = $request->get('year', $request->get('anio'));
                $query->where(function ($q) use ($year) {
                    $q->whereYear('proc_sel_cas_fecha_inicio', $year)
                      ->orWhereYear('cas_proc_sel_fecha_fin_inscripcion', $year)
                      ->orWhere('proc_sel_cas_descripcion', 'ILIKE', "%{$year}%");
                });
            }

            if ($request->filled('search') || $request->filled('bus')) {
                $search = $request->get('search', $request->get('bus'));
                $query->where('proc_sel_cas_descripcion', 'ILIKE', "%{$search}%");
            }

            $proceso = $query->orderBy('id_proc_sel_cas', 'DESC')->get();

            $archivos = $this->db()->table('archivo_sel_cas')
                ->join('cas_proceso_seleccion', 'archivo_sel_cas.id_proceso_selec', '=', 'cas_proceso_seleccion.id_proc_sel_cas')
                ->where('cas_proceso_seleccion.iddireccionweb', $idDireccion)
                ->select(
                    'archivo_sel_cas.idarchivo_sel_cas',
                    'archivo_sel_cas.nom_archivo',
                    'archivo_sel_cas.url_archivo',
                    'archivo_sel_cas.archivo_sinurl',
                    'archivo_sel_cas.etapa',
                    'archivo_sel_cas.id_proceso_selec'
                )
                ->orderBy('archivo_sel_cas.idarchivo_sel_cas', 'ASC')
                ->get();

            $newDatos = [];
            foreach ($proceso as $itemproc) {
                $final = [];
                $entrevista = [];
                $curricular = [];
                $inscripcion = [];

                foreach ($archivos as $arc) {
                    if ($itemproc->id_proc_sel_cas == $arc->id_proceso_selec) {
                        $url = $arc->url_archivo ? trim($arc->url_archivo) : '';
                        if (empty($url) && !empty($arc->archivo_sinurl)) {
                            $url = $this->cleanImagePath($arc->archivo_sinurl);
                        }
                        $fileItem = [
                            'id' => $arc->idarchivo_sel_cas,
                            'nom_archivo' => trim($arc->nom_archivo ?? ''),
                            'url_archivo' => $url,
                            'etapa' => $arc->etapa
                        ];
                        if ($arc->etapa == 'FINAL') $final[] = $fileItem;
                        elseif ($arc->etapa == 'ENTREVISTA') $entrevista[] = $fileItem;
                        elseif ($arc->etapa == 'CURRICULAR') $curricular[] = $fileItem;
                        elseif ($arc->etapa == 'INSCRIPCION') $inscripcion[] = $fileItem;
                    }
                }

                $detalles = [
                    'inscripcion' => $inscripcion,
                    'curricular' => $curricular,
                    'entrevista' => $entrevista,
                    'final' => $final
                ];

                $fechaini = $itemproc->proc_sel_cas_fecha_inicio;
                $fechains = $itemproc->cas_proc_sel_fecha_fin_inscripcion;
                $fechafin = $itemproc->proc_sel_cas_fecha_termino;
                $fecharesul = $itemproc->cas_proc_sel_fecha_resultados;

                $fecha_actual = strtotime(date("Y-m-d H:i:s"));
                $texto = 'NUEVO';
                $badgeClass = 'badge bg-success';
                $colofondo = 'background:#c0e0d3;';

                $tsResul = !empty($fecharesul) ? strtotime($fecharesul) : null;
                $tsInsc = !empty($fechains) ? strtotime($fechains) : null;
                $tsFin = !empty($fechafin) ? strtotime($fechafin) : null;

                if ($tsResul && $fecha_actual > $tsResul) {
                    $texto = 'CONCLUIDO';
                    $badgeClass = 'badge bg-danger';
                    $colofondo = 'background:#ffe5e5;';
                } elseif ($tsInsc && $fecha_actual > $tsInsc) {
                    $texto = 'EN PROCESO';
                    $badgeClass = 'badge bg-warning text-dark';
                    $colofondo = 'background:#f7d097;';
                }

                // Extraer año para filtro
                $anio = date('Y', strtotime($fechaini ?: ($itemproc->created_at ?? date('Y-m-d'))));
                if (preg_match('/202\d/', $itemproc->proc_sel_cas_descripcion ?? '', $matches)) {
                    $anio = $matches[0];
                }

                $newDatos[] = [
                    'idproceso' => $itemproc->id_proc_sel_cas,
                    'nom_proceso' => html_entity_decode(trim($itemproc->proc_sel_cas_descripcion ?? '')),
                    'ini_insc' => $itemproc->proc_sel_cas_fecha_inicio,
                    'fin_insc' => $itemproc->cas_proc_sel_fecha_fin_inscripcion,
                    'fecha_res' => $itemproc->cas_proc_sel_fecha_resultados,
                    'fecha_termino' => $itemproc->proc_sel_cas_fecha_termino,
                    'color_fondo' => $colofondo,
                    'span' => $badgeClass,
                    'texto' => $texto,
                    'anio' => $anio,
                    'detalle' => $detalles
                ];
            }

            return response()->json([
                'convocatorias' => $newDatos,
                'data' => $newDatos,
                'total' => count($newDatos)
            ], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['convocatorias' => [], 'data' => []], 200);
        }
    }

    /**
     * 8. Videos de Inicio (videosini)
     */
    public function videosini(Request $request)
    {
        $idDireccion = $request->iddirecciones_web ?? 11;

        try {
            $publicacion = $this->db()->table('videos')
                ->where('estado', 1)
                ->where('iddirecciones_web', $idDireccion)
                ->orderBy('id', 'DESC')
                ->limit(8)
                ->get();

            $datos = [];
            foreach ($publicacion as $v) {
                $titulo = html_entity_decode($v->titulo ?? '');
                $url = html_entity_decode($v->url ?? '');
                $idvideo = '';
                if (preg_match('%(?:youtube(?:-nocookie)?\\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                    $idvideo = $match[1];
                }
                $datos[] = [
                    'id' => $v->id,
                    'titulo' => $titulo,
                    'url' => $url,
                    'idvideo' => $idvideo,
                    'fecha' => $v->created_at
                ];
            }

            return response()->json(['listavideos' => $datos, 'data' => $datos], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['listavideos' => [], 'data' => []], 200);
        }
    }

    /**
     * 9. Paginas y Secciones
     */
    public function pagina(Request $request, $id)
    {
        $idDireccion = $this->resolveIdDireccion($request);

        try {
            $datos = $this->db()->table('pagina')
                ->where('id_pagina', $id)
                ->where('iddirecciones_web', $idDireccion)
                ->get();

            if ($datos->isEmpty()) {
                $datos = $this->db()->table('pagina')
                    ->where('id_pagina', $id)
                    ->get();
            }

            return response()->json(['pagina' => $datos, 'data' => $datos], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['pagina' => [], 'data' => []], 200);
        }
    }

    public function secciones(Request $request)
    {
        $idDireccion = $request->iddirecciones_web ?? 11;

        try {
            $secciones = $this->db()->table('secciones')
                ->where('activo', 1)
                ->where('iddirecciones_web', $idDireccion)
                ->orderBy('seccion_pag', 'ASC')
                ->orderBy('idseccion', 'DESC')
                ->get();

            $datos = collect($secciones)->map(function ($s) {
                $obj = (array) $s;
                $obj['archivo_imagen'] = $this->cleanImagePath($obj['archivo_imagen'] ?? '');
                return $obj;
            })->all();

            return response()->json(['secciones' => $datos, 'data' => $datos], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['secciones' => []], 200);
        }
    }

    public function enlacerefe(Request $request)
    {
        $idDireccion = $request->iddirecciones_web ?? 11;

        try {
            $ereferencial = $this->db()->table('enlacerefe')
                ->where('activo_refe', 1)
                ->where('iddirecciones_web', $idDireccion)
                ->orderBy('idenlacerefe', 'ASC')
                ->get();

            $datos = [];
            foreach ($ereferencial as $ref) {
                $datos[] = [
                    'idref' => $ref->idenlacerefe,
                    'entidad_ref' => $ref->entidad_ref,
                    'img_refe' => $this->cleanImagePath($ref->img_refe ?? ''),
                    'link_refe' => $ref->link_refe,
                    'fecha' => $ref->created_at
                ];
            }

            return response()->json(['referenciales' => $datos, 'data' => $datos], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['referenciales' => []], 200);
        }
    }

    /**
     * 10. Visitas
     */
    public function visitas(Request $request)
    {
        $idDireccion = $request->iddirecciones_web ?? 11;

        try {
            $publicacion = $this->db()->table('regvisita')
                ->where('iddirecciones_web', $idDireccion)
                ->orderBy('idregvisita', 'DESC')
                ->paginate(10);

            return response()->json(['visitas' => $publicacion, 'data' => $publicacion->items()], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['visitas' => []], 200);
        }
    }

    public function buscarvisita(Request $request, $bus)
    {
        $idDireccion = $request->iddirecciones_web ?? 11;

        try {
            $publicacion = $this->db()->table('regvisita')
                ->where('nombre', 'ILIKE', '%' . $bus . '%')
                ->where('iddirecciones_web', $idDireccion)
                ->orderBy('idregvisita', 'DESC')
                ->paginate(200);

            return response()->json(['visitas' => $publicacion, 'data' => $publicacion->items()], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['visitas' => []], 200);
        }
    }

    /**
     * 11. Popups y Alertas
     */
    public function listapopup(Request $request)
    {
        $idDireccion = $this->resolveIdDireccion($request);

        try {
            $publicacion = $this->db()->table('popup')
                ->where('activogral', 1)
                ->where('iddirecciones_web', $idDireccion)
                ->orderBy('idpopup', 'DESC')
                ->get();

            $datos = collect($publicacion)->map(function ($p) {
                $obj = (array) $p;
                $obj['nompopup'] = $this->cleanImagePath($obj['nompopup'] ?? '');
                return $obj;
            })->all();

            return response()->json(['popup' => $datos, 'data' => $datos], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['popup' => []], 200);
        }
    }

    /**
     * 12. Sliders de Portada
     */
    public function slider(Request $request)
    {
        $idDireccion = $request->iddirecciones_web ?? 11;

        try {
            $slider = $this->db()->table('slider')
                ->where('iddirecciones_web', $idDireccion)
                ->where('activo_slider', 1)
                ->orderBy('idslider', 'DESC')
                ->get();

            $datos = collect($slider)->map(function ($s) {
                $obj = (array) $s;
                $obj['img_slider'] = $this->cleanImagePath($obj['img_slider'] ?? '');
                return $obj;
            })->all();

            return response()->json(['slider' => $datos, 'data' => $datos], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['slider' => []], 200);
        }
    }

    /**
     * 13. FAG (Fondo de Apoyo Gerencial)
     */
    public function fag(Request $request)
    {
        $idDireccion = $request->iddirecciones_web ?? 11;

        try {
            $listafag = $this->db()->table('fag')
                ->where('iddirecciones_web', $idDireccion)
                ->orderByRaw('ano DESC')
                ->paginate(12);

            return response()->json(['listafag' => $listafag, 'data' => $listafag->items()], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['listafag' => []], 200);
        }
    }

    /**
     * 14. Normatividad Regional y Regulations
     */
    public function tipodoc(Request $request)
    {
        $cacheKey = 'portal_tipodoc_' . md5(json_encode($request->all()));
        return Cache::remember($cacheKey, now()->addHours(12), function () use ($request) {
            try {
                $response = Http::timeout(6)->get('https://proyectos.regionhuanuco.gob.pe/regulations/tipo', $request->toArray());
                if ($response->successful()) {
                    return $response->json();
                }
            } catch (Exception $e) {
                // Return empty array on error
            }
            return [];
        });
    }

    public function regulations(Request $request)
    {
        $cacheKey = 'portal_regulations_' . md5(json_encode($request->all()));
        return Cache::remember($cacheKey, now()->addMinutes(15), function () use ($request) {
            try {
                $response = Http::timeout(8)->get('https://proyectos.regionhuanuco.gob.pe/regulations', $request->toArray());
                if ($response->successful()) {
                    return $response->json();
                }
            } catch (Exception $e) {
                // Return empty paginated structure on error
            }
            return [
                'current_page' => 1,
                'data' => [],
                'total' => 0,
                'last_page' => 1,
            ];
        });
    }

    public function processRegulations(Request $request, $codigo)
    {
        $codigo = strtoupper(trim($codigo));
        $procesosResponse = Http::get('https://proyectos.regionhuanuco.gob.pe/regulations/processes', [
            'proc_codigo' => $codigo,
            'activo' => 1,
        ]);
        $procesos = isset($procesosResponse->json()['data']) ? $procesosResponse->json()['data'] : $procesosResponse->json();
        $proceso = collect($procesos)->firstWhere('proc_codigo', $codigo);

        if (!$proceso) {
            return response()->json(['message' => 'Proceso de normatividad no encontrado.'], 404);
        }

        $tipos = collect(explode(',', (string) $request->input('regulations_tipo')))
            ->map(function ($tipo) { return trim($tipo); })
            ->filter()
            ->values();

        $filtros = array_filter([
            'reg_year' => $request->input('reg_year'),
            'magic' => $request->input('magic'),
            'with' => 'files',
            'orders' => $request->input('orders', ['reg_date.desc']),
        ], function ($value) { return $value !== null && $value !== ''; });

        $consultas = $tipos->isNotEmpty() ? $tipos : collect([null]);
        $documentos = [];

        foreach ($consultas as $tipo) {
            $parametros = array_merge($filtros, ['reg_process_id' => $proceso['id']]);
            if ($tipo) $parametros['regulations_tipo'] = $tipo;

            $directasResponse = Http::get('https://proyectos.regionhuanuco.gob.pe/regulations', $parametros);
            $directas = isset($directasResponse->json()['data']) ? $directasResponse->json()['data'] : $directasResponse->json();

            if (is_array($directas)) {
                foreach ($directas as $documento) {
                    if (!is_array($documento) || !isset($documento['id'])) continue;
                    $documento['relacion_proceso'] = 'directa';
                    $documentos[$documento['id']] = $documento;
                }
            }
        }

        $documentos = array_values($documentos);
        usort($documentos, function ($a, $b) {
            return strcmp($b['reg_date'] ?? '', $a['reg_date'] ?? '');
        });

        $porPagina = min(max((int) $request->input('paginate', 20), 1), 50);
        $total = count($documentos);
        $ultimaPagina = max((int) ceil($total / $porPagina), 1);
        $pagina = min(max((int) $request->input('page', 1), 1), $ultimaPagina);

        return response()->json([
            'data' => array_slice($documentos, ($pagina - 1) * $porPagina, $porPagina),
            'current_page' => $pagina,
            'last_page' => $ultimaPagina,
            'per_page' => $porPagina,
            'total' => $total,
        ]);
    }

    /**
     * 15. Directorio Institucional
     */
    public function directorio(Request $request, $dir = '')
    {
        try {
            $sgdExists = config('database.connections.sgd');
            $conn = $sgdExists ? 'sgd' : $this->connection;

            $query = DB::connection($conn)->table('tram_dependencia')
                ->where('depe_tipo', 1)
                ->where('depe_estado', 1);

            if (!empty($dir)) {
                $query->where('depe_nombre', 'ILIKE', '%' . strtoupper($dir) . '%');
            }

            $directorio = $query->orderBy('iddependencia', 'ASC')->paginate(20);
            return response()->json(['directorio' => $directorio, 'data' => $directorio->items()], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['directorio' => []], 200);
        }
    }

    public function unidad(Request $request, $cod = null)
    {
        try {
            $directorio = collect();
            $connectionsToTry = ['pgsqlsgd', 'sgd', 'pgsql', $this->connection];

            foreach ($connectionsToTry as $c) {
                if (empty($c) || !config("database.connections.{$c}")) continue;
                try {
                    $query = DB::connection($c)->table('tram_dependencia');
                    if ($cod) {
                        $query->where('iddependencia', $cod);
                    }
                    $results = $query->orderBy('iddependencia', 'ASC')->get();
                    if ($results && $results->count() > 0) {
                        $directorio = $results;
                        break;
                    }
                } catch (Exception $e2) {
                    continue;
                }
            }

            return response()->json(['unidad' => $directorio, 'data' => $directorio], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['unidad' => [], 'data' => []], 200);
        }
    }

    public function organigrama()
    {
        return response()->json(['organigrama' => 'Organigrama Estructural Oficial']);
    }

    public function gesambiental(Request $request)
    {
        $iddireccionweb = $this->resolveIdDireccion($request);
        try {
            $menuIds = [113, 114];
            if ($request->filled('idmenus')) {
                $menuIds = is_array($request->idmenus) ? $request->idmenus : explode(',', $request->idmenus);
            }

            $menus = Menu::with([
                'submenus' => function ($query) {
                    $query->where('activo_submenu', 1)->orderBy('idsubmenu', 'ASC');
                },
                'submenus.pagina'
            ])
            ->whereIn('idmenus', $menuIds)
            ->where('iddirecciones_web', $iddireccionweb)
            ->orderBy('idmenus', 'ASC')
            ->get();

            $archivo = $request->get('archivo', 'ambiental.php');
            $datos = $this->db()->table('pagina')
                ->where('nom_archivophp', $archivo)
                ->where('iddirecciones_web', $iddireccionweb)
                ->get();

            return response()->json([
                'pagina' => $datos,
                'menus'  => $menus
            ], 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset'      => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json([
                'pagina' => [],
                'menus'  => [],
                'error'  => $e->getMessage()
            ], 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        }
    }

}
