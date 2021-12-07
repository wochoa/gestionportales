<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReporteVisitas extends Component
{
    public $search;

    public function render()
    {
        $iduser=Auth::user()->id;
		$idweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->value('iddirecciones_web');
        $dnweb=DB::connection('mysql')->table('direcciones_web')->where('iddirecciones_web',$idweb)->value('dns_direcciones_web');
		//$idweb = $accesoweb[0]->iddirecciones_web;

        $regvisita=DB::connection('mysql')->table('regvisita')->where('iddirecciones_web',$idweb)->where('dni', 'like', '%'.$this->search.'%')->orderBy('idregvisita','DESC')->paginate(10);
        //return view('reportevisit',compact('regvisita','dnweb'));

        return view('livewire.reporte-visitas',compact('regvisita','dnweb'));
    }
}
