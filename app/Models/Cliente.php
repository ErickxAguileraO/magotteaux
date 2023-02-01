<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory, StatusConvert;

    public $timestamps = false;
    protected $prefix = 'cli';
    protected $table = 'clientes';
    protected $primaryKey = 'cli_id';
    protected $fillable = [
        'cli_id',
        'cli_nombre',
        'cli_identificacion',
        'cli_estado',
        'cli_pais_id',
    ];


    /***********************************************************
     *  Mutators and Accessors
     ************************************************************/


    /***********************************************************
     *  Local scope
     ************************************************************/

    public function scopeWithFilters($query)
    {
        return $query->when(request('nombre') != '', function ($query) {
            $query->where('cli_nombre', 'like', "%" . request('nombre') . "%");
        })->when(request('estado') != '', function ($query) {
            $query->where('cli_estado', request('estado'));
        });
    }

    public function scopeActive($query)
    {
        return $query->where('cli_estado', 1);
    }


    /***********************************************************
     *  Eloquent relationships
     ************************************************************/

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'cli_pais_id', 'pai_id');
    }

    /***********************************************************
     *  Auxiliary functions
     ************************************************************/
}
