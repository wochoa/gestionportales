<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitaRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        if($this->input('tipopersona') === 'Persona Natural'){
            return [
                'dni'=> 'required|min:8|max:8',
                'nombre'=> 'required',
                'motivo'=> 'required',
                'oficodigo'=> 'required|not_in:0',
                'nomoficina'=> 'required',
                'nomfuncionario'=> 'required|not_in:0',
                'tipopersona'=> 'required|not_in:0',
                'iddireccionesweb'=> 'required',
                'cargo'=> 'required',
                'lugar'=> 'required',
            ];
        }else{
            return [
                'dni'=> 'required|min:8|max:8',
                'nombre'=> 'required',
                'motivo'=> 'required',
                'oficodigo'=> 'required|not_in:0',
                'nomoficina'=> 'required',
                'nomfuncionario'=> 'required|not_in:0',
                'tipopersona'=> 'required|not_in:0',
                'iddireccionesweb'=> 'required',
                'institucion'=> 'required',
                'cargo'=> 'required',
                'lugar'=> 'required',
            ];
        }
    }

    public function messages (){
        return [
            'dni.required' => 'El DNI es obligatorio',
            'dni.min' => 'El DNI debe tener como mínimo 8 dígitos',
            'dni.max' => 'El DNI debe tener como máximo 8 dígitos',
            'nombre.required' => 'El Nombre es obligatorio',
            'motivo.required' => 'El Motivo es obligatorio',
            'oficodigo.required' => 'La Oficina es obligatoria',
            'oficodigo.not_in' => 'La Oficina es obligatoria',
            'nomoficina.required' => 'La Oficina es obligatoria',
            'nomfuncionario.required' => 'El Funcionario es obligatorio',
            'nomfuncionario.not_in' => 'El Funcionario es obligatorio',
            'tipopersona.required' => 'El Tipo es obligatorio',
            'tipopersona.not_in' => 'El Tipo es obligatorio',
            'iddireccionesweb.required' => 'El Portal es obligatorio',
            'cargo.required' => 'El Cargo es obligatorio',
            'lugar.required' => 'El Lugar es obligatorio',
        ];
    }
}
