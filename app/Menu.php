<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $connection = 'pgsql_pag';
    protected $table = 'menus';
    protected $primaryKey = 'idmenus';

    public function submenus()
    {
        return $this->hasMany(Submenu::class, 'idmenus', 'idmenus');
    }
}