<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpresaTransporte extends Model
{
    use HasFactory, StatusConvert, SoftDeletes;

    public $timestamps = false;
    protected $prefix = 'emt';
    protected $table = 'empresa_transportes';
    protected $primaryKey = 'emt_id';

    /***********************************************************
     *  Local scope
     ************************************************************/

    public function scopeActive($query)
    {
        return $query->where('emt_estado', 1);
    }

    /***********************************************************
     *  Eloquent relationships
     ************************************************************/

    public function choferes()
    {
        return $this->hasMany(Chofer::class, 'cho_empresa_id', 'emt_id');
    }

    public function patentes()
    {
        return $this->hasMany(Patente::class, 'pat_empresa_id', 'emt_id');
    }

    public function cargas()
    {
        return $this->hasMany(Carga::class, 'car_empresa_id', 'emt_id');
    }
}
