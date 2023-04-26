<?php

namespace App\Console\Commands;

use App\Mail\DespachoCarga\NotificacionCarga;
use App\Models\Carga;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        if (date('H:i') === '23:59' && date('N') <= 5) {

            $cargas = Carga::where('car_email_enviado', 0)
                ->whereDate('car_fecha_salida', '<=', today())
                ->whereHas('cliente.frecuencias', function ($query) {
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
                ->whereHas('cliente.frecuencias', function ($query) {
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

        // Enviar correo quincenalmente los días 15 y último día hábil del mes validado que sean dia habiles

        $fechaActual = CarbonImmutable::now(); // Obtiene la fecha y hora actual
        if (
            ($fechaActual->day === 15 && $fechaActual->isWeekday())
            || ($fechaActual->day === 16 && $fechaActual->isWeekday() && !$fechaActual->subDay()->isWeekday())
            || ($fechaActual->day === 17 && $fechaActual->isWeekday() && !$fechaActual->subDays(2)->isWeekday() && !$fechaActual->subDays(1)->isWeekday())
        ) {
            $cargas = Carga::where('car_email_enviado', 0)
                ->whereDate('car_fecha_salida', '<=', today())
                ->whereHas('cliente.frecuencias', function ($query) {
                    $query->where('fre_frecuencia', 'Quincenal');
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

        $fechaActual = CarbonImmutable::now(); // Obtiene la fecha y hora actual
        $ultimoDiaMes = $fechaActual->endOfMonth()->dayOfWeek === CarbonImmutable::SUNDAY
            ? $fechaActual->endOfMonth()->nextWeekday()
            : $fechaActual->endOfMonth();

        // Verifica si es el último día del mes o un día hábil posterior al último día del mes
        if ($fechaActual->equalTo($ultimoDiaMes) || $fechaActual->isAfter($ultimoDiaMes)) {
            // Código a ejecutar en caso de que se cumpla la condición
            $cargas = Carga::where('car_email_enviado', 0)
                ->whereDate('car_fecha_salida', '<=', today())
                ->whereHas('cliente.frecuencias', function ($query) {
                    $query->whereIn('fre_frecuencia', ['Mensual', 'Quincenal']);
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
    }
}
