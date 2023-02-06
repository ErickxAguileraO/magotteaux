<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patente extends Model
{
    use HasFactory, StatusConvert;

    public $timestamps = false;
    protected $prefix = 'pat';
    protected $table = 'patentes';
    protected $primaryKey = 'pat_id';

    /***********************************************************
     *  Local scope
     ************************************************************/

    public function scopeActive($query)
    {
        return $query->where('pat_estado', 1);
    }
}
