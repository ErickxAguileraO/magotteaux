<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chofer extends Model
{
    use HasFactory, StatusConvert, SoftDeletes;

    public $timestamps = false;
    protected $prefix = 'cho';
    protected $table = 'choferes';
    protected $primaryKey = 'cho_id';
    protected $fillable = [
        'cho_id',
        'cho_nombre',
        'cho_apellido',
        'cho_identificacion',
        'cho_estado',
        'cho_empresa_id',
    ];


    /***********************************************************
     *  Mutators and Accessors
     ************************************************************/


    /***********************************************************
     *  Local scope
     ************************************************************/

    public function scopeActive($query)
    {
        return $query->where('cho_estado', 1);
    }


    /***********************************************************
     *  Eloquent relationships
     ************************************************************/

    public function empresaTransporte()
    {
        return $this->belongsTo(EmpresaTransporte::class, 'cho_empresa_id', 'emt_id');
    }

    public function cargas()
    {
        return $this->hasMany(Carga::class, 'car_chofer_id', 'cho_id');
    }

    /***********************************************************
     *  Auxiliary functions
     ************************************************************/
}
