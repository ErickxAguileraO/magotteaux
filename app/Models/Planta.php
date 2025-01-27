<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Planta extends Model
{
    use HasFactory, StatusConvert, SoftDeletes;

    public $timestamps = false;
    protected $prefix = 'pla';
    protected $table = 'plantas';
    protected $primaryKey = 'pla_id';
    protected $fillable = [
        'pla_id',
        'pla_nombre',
        'pla_estado',
        'pla_pais_id',
    ];

    /***********************************************************
     *  Local scope
     ************************************************************/

    public function scopeActive($query)
    {
        return $query->where('pla_estado', 1);
    }

    /***********************************************************
     *  Eloquent relationships
     ************************************************************/

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pla_pais_id', 'pai_id');
    }

    public function cargas()
    {
        return $this->hasMany(Carga::class, 'car_planta_id', 'pla_id');
    }
}
