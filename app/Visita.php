<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model{
    protected $connection = 'pgsql_pag';
    protected $table = 'regvisita';
    protected $primaryKey = 'idregvisita';

    protected $fillable =[
        'dni',
        'nombre',
        'motivo',
        'fechaingreso',
        'estado',
        'fechasalida',
        'ofi_codigo',
        'nom_oficina',
        'nom_funcionario',
        'tipo_persona',
        'iddirecciones_web',
        'institucion',
        'cargo',
        'lugar',
        'observaciones'
    ];
}
