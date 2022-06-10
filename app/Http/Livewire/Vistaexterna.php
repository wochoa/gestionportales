<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Vistaexterna extends Component
{
    public $idweb;
    public $buscar;
    public function render()
    {
        // $nombredireccion=DB::connection('mysql')->table('direcciones_web')->where('iddirecciones_web',$id)->value('nom_direcciones_web');

        $consulta=DB::connection('mysql')->table('regvisita')->where('iddirecciones_web',$this->idweb)->where('dni', 'like', '%'.$this->buscar.'%')->paginate(10);
        return view('livewire.vistaexterna',compact('consulta'));

        //return view('livewire.vistaexterna');
    }
}
