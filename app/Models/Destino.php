<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use HasFactory, StatusConvert;

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

        /***********************************************************
     *  Eloquent relationships
     ************************************************************/

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'des_cliente_id', 'cli_id');
    }
}
