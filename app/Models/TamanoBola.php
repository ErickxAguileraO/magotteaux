<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TamanoBola extends Model
{
    use HasFactory, SoftDeletes, StatusConvert;

    public $timestamps = false;
    protected $prefix = 'tab';
    protected $table = 'tamano_bolas';
    protected $primaryKey = 'tab_id';
    protected $fillable = [
        'tab_id',
        'tab_tamano',
        'tab_estado',
    ];


    /***********************************************************
     *  Local scope
     ************************************************************/

     public function scopeActive($query)
     {
         return $query->where('tab_estado', 1);
     }

     public function cargas()
     {
         return $this->hasMany(Carga::class, 'car_tamano_bola_id', 'tab_id');
     }
}
