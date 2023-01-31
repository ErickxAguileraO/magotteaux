<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoCarga extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'punto_cargas';
    protected $primaryKey = 'puc_id';
    protected $fillable = [
        'puc_id',
        'puc_nombre',
        'puc_estado',
        'puc_planta_id',
    ];

    public function planta()
    {
        return $this->belongsTo(Planta::class, 'puc_planta_id', 'pla_id');
    }

}
