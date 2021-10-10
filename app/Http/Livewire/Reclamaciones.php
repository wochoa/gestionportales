<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Reclamaciones extends Component
{
    public function render()
    {
        $iduser=Auth::user()->id;
		$iddirweb=DB::connection('mysql')->table('userportales')->where('iduser',$iduser)->value('iddirecciones_web');
        $datos=DB::connection('mysql')->table('reclamaciones')->where('iddirecciones_web',$iddirweb)->get();
        return view('livewire.reclamaciones',['reclamaciones'=>$datos]);
    }
}
