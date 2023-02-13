<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pais extends Model
{
    use HasFactory, StatusConvert, SoftDeletes;

    public $timestamps = false;
    protected $prefix = 'pai';
    protected $table = 'paises';
    protected $primaryKey = 'pai_id';

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'cli_pais_id', 'pai_id');
    }

    public function plantas()
    {
        return $this->hasMany(Planta::class, 'pla_pais_id', 'pai_id');
    }
}


