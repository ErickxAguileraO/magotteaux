<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planta extends Model
{
    use HasFactory, StatusConvert;

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

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pla_pais_id', 'pai_id');
    }
}
