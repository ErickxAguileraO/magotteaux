<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaTransporte extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'empresa_transportes';
    protected $primaryKey = 'emt_id';
}
