<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    const TIPO_LOGISTICA = 1;
    const TIPO_CLIENTE = 2;
    const TIPO_ADMINISTRADOR = 3;

    protected $table = 'usuarios';
    protected $primaryKey = 'usu_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usu_id',
        'usu_nombre',
        'usu_apellido',
        'usu_identificacion',
        'usu_celular',
        'usu_email',
        'usu_estado',
        'usu_password',
        'usu_planta_id',
        'usu_cliente_id',
        'usu_destino_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'usu_password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->usu_password;
    }

    /***********************************************************
     *  Mutators and Accessors
     ************************************************************/

    public function setUsuPasswordAttribute($value)
    {
        $this->attributes['usu_password'] = bcrypt($value);
    }

     /***********************************************************
     *  Auxiliary functions
     ************************************************************/

     public function getRoleId()
     {
        if($this->hasRole('Logistica')){
            return self::TIPO_LOGISTICA;
        }

        if($this->hasRole('Cliente')){
            return self::TIPO_CLIENTE;
        }

        if($this->hasRole('Admin')){
            return self::TIPO_ADMINISTRADOR;
        }
     }
}
