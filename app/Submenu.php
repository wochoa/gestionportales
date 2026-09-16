<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    protected $connection = 'pgsql_pag';
    protected $table = 'submenu';
    protected $primaryKey = 'idsubmenu';

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'idmenus', 'idmenus');
    }

    public function pagina()
    {
        return $this->belongsTo(Pagina::class, 'idpagina', 'id_pagina');
    }
}