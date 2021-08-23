<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Fondo extends Component
{
    public $tipofondo;
    public function render()
    {   
        return view('livewire.fondo');
    }
    public function cambiofondo($id,$url)
    {
        // $user=User::find($id);
        // $user->update(['darkmode'=>$this->titulo,'body'=>$this->body]);
        // return $id;
        $datos=DB::table('admin')->where('id',$id)->get();
        $fondo=$datos[0]->darkmode;
        if($fondo<>'' or $fondo<>null)
        {
            $sql="UPDATE admin SET darkmode='' WHERE id=".$id;
        }
        else{
            $sql="UPDATE admin SET darkmode='dark-mode' WHERE id=".$id;
        }
        DB::update($sql);
        //return redirect('/');
        
        return redirect($url);
        
    }
}
