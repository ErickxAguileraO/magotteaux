<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaTransporte extends Model
{
    use HasFactory, StatusConvert;

    public $timestamps = false;
    protected $prefix = 'emt';
    protected $table = 'empresa_transportes';
    protected $primaryKey = 'emt_id';
}
