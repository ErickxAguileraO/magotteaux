<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $prefix = 'des';
    protected $table = 'destinos';
    protected $primaryKey = 'des_id';
    protected $fillable = [
        'des_id',
        'des_nombre',
        'des_estado',
        'des_cliente_id',
    ];

    /***********************************************************
     *  Local scope
     ************************************************************/

    public function scopeActive($query)
    {
        return $query->where('des_estado', 1);
    }
}
