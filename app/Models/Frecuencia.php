<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Frecuencia extends Model
{
    use HasFactory, StatusConvert, SoftDeletes;

    public $timestamps = false;
    protected $prefix = 'fre';
    protected $table = 'frecuencias';
    protected $primaryKey = 'fre_id';


    // /***********************************************************
    //  *  Local scope
    //  ************************************************************/

    // public function scopeActive($query)
    // {
    //     return $query->where('tic_estado', 1);
    // }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'fre_cliente_id', 'cli_id');
    }
}
