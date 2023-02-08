<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoCarga extends Model
{
    use HasFactory, StatusConvert;

    public $timestamps = false;
    protected $prefix = 'puc';
    protected $table = 'punto_cargas';
    protected $primaryKey = 'puc_id';
    protected $fillable = [
        'puc_id',
        'puc_nombre',
        'puc_estado',
        'puc_planta_id',
    ];

    /***********************************************************
     *  Local scope
     ************************************************************/

    public function scopeActive($query)
    {
        return $query->where('puc_estado', 1);
    }

    /***********************************************************
     *  Eloquent relationships
     ************************************************************/

    public function planta()
    {
        return $this->belongsTo(Planta::class, 'puc_planta_id', 'pla_id');
    }
}
