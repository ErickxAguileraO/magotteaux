<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public $timestamps = false;
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
        return $query->when(request('nombre'), function ($query) {
            $query->where('cli_nombre', 'like', "%" . request('nombre') . "%");
        })->when(request('estado'), function ($query) {
            $query->where('cli_estado', request('estado'));
        });
    }


    /***********************************************************
     *  Eloquent relationships
     ************************************************************/
}
