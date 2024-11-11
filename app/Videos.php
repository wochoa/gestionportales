<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    //
    protected $fillable = [
		'id', 'titulo', 'url', 'estado'
	];
    protected $table = 'admin';
}
