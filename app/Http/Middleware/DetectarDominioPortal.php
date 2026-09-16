<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetectarDominioPortal
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Obtener dominio de la peticion (desde Header o Query)
        $rawDomain = $request->header('X-Portal-Domain')
                  ?? $request->header('Origin')
                  ?? $request->header('Referer')
                  ?? $request->query('domain');

        $domain = $this->sanitizarDominio($rawDomain);
        $host = parse_url($domain, PHP_URL_HOST) ?? $domain;

        // 2. Busqueda ultra-flexible en direcciones_web para soportar todas las 44+ unidades
        // (DRE, DIRESA, UGELs, Redes de Salud, Hospitales, Consejos, etc.)
        $direccion = DB::connection('pgsql_pag')->table('direcciones_web')
            ->where(function($q) use ($domain, $host) {
                $q->where('dns_direcciones_web', $domain)
                  ->orWhere('dns_direcciones_web', $domain . '/')
                  ->orWhere('linkdirecciones_web', $domain)
                  ->orWhere('linkdirecciones_web', $domain . '/')
                  ->orWhere('dns_direcciones_web', 'ILIKE', '%' . $host . '%')
                  ->orWhere('linkdirecciones_web', 'ILIKE', '%' . $host . '%');
            })
            ->first();

        // 3. Extraer iddirecciones_web y dependencias de la entidad correspondiente
        $idDireccionesWeb = $direccion && isset($direccion->iddirecciones_web) ? $direccion->iddirecciones_web : 11;
        $idDependencias = 3;
        if ($direccion) {
            $props = (array) $direccion;
            foreach ($props as $k => $v) {
                if (strpos($k, 'depende') !== false && !is_null($v)) {
                    $idDependencias = $v;
                    break;
                }
            }
        }
        $nombre = $direccion && isset($direccion->nom_direcciones_web) ? $direccion->nom_direcciones_web : 'GOBIERNO REGIONAL HUANUCO';

        // 4. Inyectar datos en el Request
        $request->merge([
            'iddirecciones_web' => $idDireccionesWeb,
            'iddependencias'    => $idDependencias,
            'portal_nombre'     => $nombre,
            'portal_dominio'    => $domain,
            'portal_registro'   => $direccion
        ]);

        return $next($request);
    }

    private function sanitizarDominio(?string $url): string
    {
        if (empty($url)) {
            return 'http://localhost:5173';
        }

        $parsed = parse_url($url);
        if (isset($parsed['scheme']) && isset($parsed['host'])) {
            $port = isset($parsed['port']) ? ':' . $parsed['port'] : '';
            return $parsed['scheme'] . '://' . $parsed['host'] . $port;
        }

        return rtrim($url, '/');
    }
}
