<?php

namespace App\Models;

use App\Traits\StatusConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carga extends Model
{
    use HasFactory, StatusConvert, SoftDeletes;

    const EMAIL_ENVIADO = 1;
    const EMAIL_NO_ENVIADO = 0;

    public $timestamps = false;
    protected $prefix = 'car';
    protected $table = 'cargas';
    protected $primaryKey = 'car_id';
    protected $fillable = [
        'car_fecha_carga',
        'car_fecha_salida',
        'car_guia_despacho',
        'car_certificado_calidad',
        'car_imagen_patente',
        'car_imagen_carga',
        'car_email_enviado',
        'car_token',
        'car_empresa_id',
        'car_planta_id',
        'car_tipo_id',
        'car_tamano_bola_id',
        'car_patente_id',
        'car_chofer_id',
        'car_cliente_id',
        'car_destino_id',
        'car_punto_carga_id',
        'car_numero_guia_despacho',
    ];

    protected $dates = [
        'car_fecha_carga',
        'car_fecha_salida',
    ];


    /***********************************************************
     *  Mutators and Accessors
     ************************************************************/


    /***********************************************************
     *  Local scope
     ************************************************************/

    public function scopeEmailSent($query)
    {
        return $query->where('car_email_enviado', self::EMAIL_ENVIADO);
    }

    public function scopeEmailNotSent($query)
    {
        return $query->where('car_email_enviado', self::EMAIL_NO_ENVIADO);
    }

    public function scopeForClient($query)
    {
        return $query->where('car_cliente_id', auth()->user()->usu_cliente_id)
            ->where('car_destino_id', auth()->user()->usu_destino_id)
            ->orderBy('car_email_enviado');
    }


    /***********************************************************
     *  Eloquent relationships
     ************************************************************/

    public function empresaTransporte()
    {
        return $this->belongsTo(EmpresaTransporte::class, 'car_empresa_id', 'emt_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'car_usuario_id', 'usu_id');
    }

    public function patente()
    {
        return $this->belongsTo(Patente::class, 'car_patente_id', 'pat_id');
    }

    public function tipoCarga()
    {
        return $this->belongsTo(TipoCarga::class, 'car_tipo_id', 'tic_id');
    }

    public function tamanoBola()
    {
        return $this->belongsTo(TamanoBola::class, 'car_tamano_bola_id', 'tab_id');
    }

    public function puntoCarga()
    {
        return $this->belongsTo(PuntoCarga::class, 'car_punto_carga_id', 'puc_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'car_cliente_id', 'cli_id');
    }

    public function destino()
    {
        return $this->belongsTo(Destino::class, 'car_destino_id', 'des_id');
    }

    public function cargas()
    {
        return $this->hasMany(Carga::class, 'car_empresa_id', 'emt_id');
    }

    public function tipo()
    {
        return $this->belongsTo(TipoCarga::class, 'car_tipo_id', 'tic_id');
    }

    public function planta()
    {
        return $this->belongsTo(Planta::class, 'car_planta_id', 'pla_id');
    }

    public function chofer()
    {
        return $this->belongsTo(Chofer::class, 'car_chofer_id', 'cho_id');
    }


    /***********************************************************
     *  Auxiliary functions
     ************************************************************/
}
