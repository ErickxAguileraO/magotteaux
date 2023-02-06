<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carga extends Model
{
    use HasFactory, StatusConvert, SoftDeletes;

    public $timestamps = false;
    protected $prefix = 'car';
    protected $table = 'cargas';
    protected $primaryKey = 'car_id';
    protected $fillable = [
        'car_id',
        'car_fecha_carga',
        'car_fecha_salida',
        'car_guia_despacho',
        'car_certificado_calidad',
        'car_imagen_patente',
        'car_imagen_carga',
        'car_email_enviado',
        'car_token',
    ];


    /***********************************************************
     *  Mutators and Accessors
     ************************************************************/


    /***********************************************************
     *  Local scope
     ************************************************************/

    public function scopeActive($query)
    {
        return $query->where('car_estado', 1);
    }


    /***********************************************************
     *  Eloquent relationships
     ************************************************************/

    public function empresaTransporte()
    {
        return $this->belongsTo(EmpresaTransporte::class, 'car_empresa_id', 'emt_id');
    }

    public function cargas()
    {
        return $this->hasMany(Carga::class, 'car_empresa_id', 'emt_id');
    }

    /***********************************************************
     *  Auxiliary functions
     ************************************************************/
}
