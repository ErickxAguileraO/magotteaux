<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCarga extends Model
{
    use HasFactory, StatusConvert;

    public $timestamps = false;
    protected $prefix = 'tic';
    protected $table = 'tipo_cargas';
    protected $primaryKey = 'tic_id';
}
