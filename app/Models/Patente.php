<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patente extends Model
{
    use HasFactory, StatusConvert, SoftDeletes;

    public $timestamps = false;
    protected $prefix = 'pat';
    protected $table = 'patentes';
    protected $primaryKey = 'pat_id';
    protected $fillable = [
        'pat_id',
        'pat_patente',
        'pat_estado',
        'pat_empresa_id',
    ];

    /***********************************************************
     *  Local scope
     ************************************************************/

    public function scopeActive($query)
    {
        return $query->where('pat_estado', 1);
    }

    /***********************************************************
     *  Eloquent relationships
     ************************************************************/

    public function empresaTransporte()
    {
        return $this->belongsTo(EmpresaTransporte::class, 'pat_empresa_id', 'emt_id');
    }

    public function cargas()
    {
        return $this->hasMany(Carga::class, 'car_patente_id', 'pat_id');
    }
}
