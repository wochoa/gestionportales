<?php
namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Helper
{
    public static function mestoCadena($mes){
        $cadena = '';
        switch ($mes) {
            case 1:
                $cadena = 'Enero';
                break;
            case 2:
                $cadena = 'Febrero';
                break;
            case 3:
                $cadena = 'Marzo';
                break;
            case 4:
                $cadena = 'Abril';
                break;
            case 5:
                $cadena = 'Mayo';
                break;
            case 6:
                $cadena = 'Junio';
                break;
            case 7:
                $cadena = 'Julio';
                break;
            case 8:
                $cadena = 'Agosto';
                break;
            case 9:
                $cadena = 'Setiembre';
                break;
            case 10:
                $cadena = 'Octubre';
                break;
            case 11:
                $cadena = 'Noviembre';
                break;
            case 12:
                $cadena = 'Diciembre';
                break;
        }

        return $cadena;
    }

    public static function extraerAnio($fecha){
        return Carbon::createFromFormat('d/m/Y', $fecha)->format('Y');
    }

    public static function limpiaEspacios($cadena){
        $cadena = str_replace(' ', '', $cadena);
        return $cadena;
    }

    public static function fechaActual(){
        return Carbon::now();
    }

    public function usuarioActual(){
        return auth()->user()->id;
    }

    public static function verificarAcceso(){
        $iduser = Auth::user()->id;
        $accesoweb = DB::connection('pgsql_pag')->table('userportales')->where('iduser',$iduser)->value('iddirecciones_web');

        return $accesoweb;
    }

    public static function convertirARomano($integer, $upcase = true){
        if($integer == 0){
            $return = 0;
        }else{
            $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100,
                'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9,
                'V'=>5, 'IV'=>4, 'I'=>1);
            $return = '';
            while($integer > 0)
            {
                foreach($table as $rom=>$arb)
                {
                    if($integer >= $arb)
                    {
                        $integer -= $arb;
                        $return .= $rom;
                        break;
                    }
                }
            }
        }
        return $return;
    }
}
