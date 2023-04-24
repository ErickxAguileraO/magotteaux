<?php

namespace App\Console\Commands;

use App\Mail\DespachoCarga\NotificacionCarga;
use App\Models\Carga;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EnviarFormulariosCarga extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enviar:formularios-carga';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía un correo con con frecuncias, diaria, semanal, quincenal, mensual';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
            // Enviar correos diariamente a las 23:59, de lunes a viernes
            if (date('H:i') === '16:38' && date('N') <= 5) {

                $cargas = Carga::where('car_email_enviado', 0)
                                ->where(function($query){
                                    $query->whereDate('car_fecha_salida', today())
                                        ->orWhereDate('car_fecha_salida', now()->subDays(2));
                                })
                                ->whereHas('cliente.frecuencias', function($query) {
                                    $query->where('fre_frecuencia', 'Diaria');
                                })
                                ->whereNotNull('car_certificado_calidad')
                                ->get();

                foreach ($cargas as $carga) {
                    // enviar correo y actualizar estado
                    $usuarioCliente = User::role('Cliente')->get();
                    $usuarioLogistica = User::role('Logistica')->get();
                    $correoLogistica = [];
                    $correoClientes = [];

                    foreach ($usuarioCliente as $clientes) {
                        if ($clientes['usu_destino_id'] == $carga->car_destino_id && $clientes['usu_estado'] == 1) {
                            $correoClientes[] = $clientes['usu_email'];
                        }
                    }

                    foreach ($usuarioLogistica as $logistica) {
                        if ($logistica['usu_planta_id'] == $carga->car_planta_id && $logistica['usu_estado'] == 1) {
                            $correoLogistica[] = $logistica['usu_email'];
                        }
                    }
                    $carga->update([
                        'car_email_enviado' => 1,
                    ]);

                    Mail::to($correoClientes)->bcc($correoLogistica)->send((new NotificacionCarga($carga)));
                }
            }

            // Enviar correo semanalmente los lunes a las 8:00 am
            if (date('H:i') === '08:00' && date('N') === '1') {

                $cargas = Carga::where('car_email_enviado', 0)
                                ->whereDate('car_fecha_salida', '<=', today())
                                ->whereHas('cliente.frecuencias', function($query) {
                                    $query->where('fre_frecuencia', 'Semanal');
                                })
                                ->whereNotNull('car_certificado_calidad')
                                ->get();

                foreach ($cargas as $carga) {
                    // enviar correo y actualizar estado
                    $usuarioCliente = User::role('Cliente')->get();
                    $usuarioLogistica = User::role('Logistica')->get();
                    $correoLogistica = [];
                    $correoClientes = [];

                    foreach ($usuarioCliente as $clientes) {
                        if ($clientes['usu_destino_id'] == $carga->car_destino_id && $clientes['usu_estado'] == 1) {
                            $correoClientes[] = $clientes['usu_email'];
                        }
                    }

                    foreach ($usuarioLogistica as $logistica) {
                        if ($logistica['usu_planta_id'] == $carga->car_planta_id && $logistica['usu_estado'] == 1) {
                            $correoLogistica[] = $logistica['usu_email'];
                        }
                    }

                    $carga->update([
                        'car_email_enviado' => 1,
                    ]);

                    Mail::to($correoClientes)->bcc($correoLogistica)->send((new NotificacionCarga($carga)));
                }
            }

            // Enviar correo quincenalmente los días 15 y último día hábil del mes
            $fechaActual = Carbon::now();

            if (date('H:i') === '08:00' && ($fechaActual->day === 15 && $fechaActual->isWeekday()) ||
                ($fechaActual->day === 16 && $fechaActual->isWeekday()) ||
                ($fechaActual->day === 17 && $fechaActual->isWeekday()) ||
                (date('t') === date('d') && date('N') <= 5)) {

                $cargas = Carga::where('car_email_enviado', 0)
                                ->when(date('d') <= 15 && date('N') <= 5, function ($query) {
                                    $endDate = Carbon::parse('previous weekday')->format('Y-m-d');
                                    $lastSentDate = now()->subMonth()->endOfMonth();
                                    return $query->whereBetween('car_fecha_salida', [$lastSentDate, $endDate]);
                                })
                                ->when(date('d') === '01' || (date('d') > 15 && date('t') === date('d') && date('N') <= 5), function ($query) {
                                    $lastSentDate = now()->subMonth()->endOfMonth();
                                    $endDate = now()->endOfMonth()->format('Y-m-d');
                                    return $query->whereBetween('car_fecha_salida', [$lastSentDate, $endDate])
                                        ->where('car_email_enviado', 0);
                                })
                                ->whereNotNull('car_certificado_calidad')
                                ->whereHas('cliente.frecuencias', function ($query) {
                                    $query->where('fre_frecuencia', 'Quincenal');
                                })
                                ->get();

                foreach ($cargas as $carga) {
                    // enviar correo y actualizar estado
                    $usuarioCliente = User::role('Cliente')->get();
                    $usuarioLogistica = User::role('Logistica')->get();
                    $correoLogistica = [];
                    $correoClientes = [];

                    foreach ($usuarioCliente as $clientes) {
                        if ($clientes['usu_destino_id'] == $carga->car_destino_id && $clientes['usu_estado'] == 1) {
                            $correoClientes[] = $clientes['usu_email'];
                        }
                    }

                    foreach ($usuarioLogistica as $logistica) {
                        if ($logistica['usu_planta_id'] == $carga->car_planta_id && $logistica['usu_estado'] == 1) {
                            $correoLogistica[] = $logistica['usu_email'];
                        }
                    }

                    $carga->update([
                        'car_email_enviado' => 1,
                    ]);

                    Mail::to($correoClientes)->bcc($correoLogistica)->send((new NotificacionCarga($carga)));
                }
            }

            // Enviar correo mensualmente el último día hábil del mes a las 8:00 am
            if (date('H:i') === '08:00' && date('t') === date('d') && date('N') <= 5) {

                // Obtener el último día hábil del mes anterior
                $lastSentDate = Carbon::parse('previous weekday')->format('Y-m-d');

                // Obtener el último día hábil del mes actual
                $endDate = now()->endOfMonth()->format('Y-m-d');

                $cargas = Carga::where('car_email_enviado', 0)
                                ->whereNotNull('car_certificado_calidad')
                                ->whereBetween('car_fecha_salida', [$lastSentDate, $endDate])
                                ->whereHas('cliente.frecuencias', function($query) {
                                    $query->where('fre_frecuencia', 'Mensual');
                                })
                                ->get();

                foreach ($cargas as $carga) {
                    // enviar correo y actualizar estado
                    $usuarioCliente = User::role('Cliente')->get();
                    $usuarioLogistica = User::role('Logistica')->get();
                    $correoLogistica = [];
                    $correoClientes = [];

                    foreach ($usuarioCliente as $clientes) {
                        if ($clientes['usu_destino_id'] == $carga->car_destino_id && $clientes['usu_estado'] == 1) {
                            $correoClientes[] = $clientes['usu_email'];
                        }
                    }

                    foreach ($usuarioLogistica as $logistica) {
                        if ($logistica['usu_planta_id'] == $carga->car_planta_id && $logistica['usu_estado'] == 1) {
                            $correoLogistica[] = $logistica['usu_email'];
                        }
                    }

                    $carga->update([
                        'car_email_enviado' => 1,
                    ]);

                    Mail::to($correoClientes)->bcc($correoLogistica)->send((new NotificacionCarga($carga)));
                }
            }
        }
}
