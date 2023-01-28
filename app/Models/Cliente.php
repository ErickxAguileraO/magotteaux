<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'cli_id';
    protected $fillable = [
        'cli_nombre',
        'cli_identificacion',
        'cli_pais_id',
        'cli_estado',
        'pai_nombre',
        'pai_estado',
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'cli_pais_id', 'pai_id');
    }
}
