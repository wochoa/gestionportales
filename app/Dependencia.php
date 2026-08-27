<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model{
    protected $connection = 'pgsql';
    protected $table = 'tram_dependencia';
}
