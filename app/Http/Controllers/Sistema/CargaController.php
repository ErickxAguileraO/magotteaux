<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateRecuperarPasswordRequest;
use App\Http\Requests\NotificacionCarga\CreateNotificacionCargaRequest;
use App\Mail\DespachoCarga\NotificacionCarga;
use App\Mail\RestaurarPassword\PasswordRestaurada;
use App\Models\Carga;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use Spatie\Permission\Contracts\Role;

class CargaController extends Controller
{

    public function detalleCarga($id)
    {
        $detalleCarga = Carga::findOrFail($id);
        return view('sistema.NotificacionCarga.detalle', compact('detalleCarga'));
    }

    public function sendEmail ($id)
    {

        $horaActual = Carbon::now();
        $carga = Carga::findOrFail($id);
        //dd($horaActual,$carga);
        if ($carga->car_email_enviado == 0) {
            return 'Error de envio, el correo ya fue enviado';
        }
        if ($carga->car_fecha_salida < $horaActual) {
            return 'Error de envio, la fecha de salia es mejor a la actual, tiene que ser mayor o igual';
        }

        Mail::to($carga->usuario->usu_email)->send((new NotificacionCarga($carga)));
        return redirect()->route('cliente.index')->with(['message' => 'Se envió el correo exitosamente', 'type' => 'success']);
    }
}
