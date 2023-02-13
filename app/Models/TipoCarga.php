<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoCarga extends Model
{
    use HasFactory, StatusConvert, SoftDeletes;

    public $timestamps = false;
    protected $prefix = 'tic';
    protected $table = 'tipo_cargas';
    protected $primaryKey = 'tic_id';


    /***********************************************************
     *  Local scope
     ************************************************************/

    public function scopeActive($query)
    {
        return $query->where('tic_estado', 1);
    }

    public function cargas()
    {
        return $this->hasMany(Carga::class, 'car_tipo_id', 'tic_id');
    }
}
