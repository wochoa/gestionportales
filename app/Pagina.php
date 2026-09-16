<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagina extends Model
{
    protected $connection = 'pgsql_pag';
    protected $table = 'pagina';
    protected $primaryKey = 'id_pagina';

    public function submenus()
    {
        return $this->hasMany(Submenu::class, 'idpagina', 'id_pagina');
    }
}