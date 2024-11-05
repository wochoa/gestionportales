<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model{
    protected $connection = 'pgsql';
    protected $table = 'admin';
}
