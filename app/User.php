<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
	use HasRoles;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id', 'adm_name', 'adm_lastname', 'adm_email', 'adm_dni', 'adm_inicial', 'adm_estado', 'adm_cargo', 'depe_id', 'adm_vigencia', 'adm_observacion', 'adm_tipo', 'adm_caseta', 'adm_esjefe', 'adm_telefono', 'adm_direccion', 'adm_con_especialidad', 'darkmode', 'push_id', 'avatar', 'adm_correo', 'adm_password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	protected $table = 'admin';

	public function getAuthPassword() {
		return $this->adm_password;
	}
}
