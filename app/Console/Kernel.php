<?php

namespace App\Console;

use App\Mail\DespachoCarga\NotificacionCarga;
use App\Models\Carga;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\EnviarFormulariosCarga::class
    ];
    protected function schedule(Schedule $schedule)
    {
                // Enviar correos diariamente a las 23:59, de lunes a viernes
                $schedule->command('enviar:formularios-carga')
                    ->weekdays()
                    ->dailyAt('16:38');

                // Enviar correo semanalmente los lunes a las 8:00 am
                $schedule->command('enviar:formularios-carga')
                    ->mondays()
                    ->at('08:00');

                // Enviar correo quincenalmente los días 15 y último día hábil del mes
                $schedule->command('enviar:formularios-carga')
                        ->when(function () {
                            $fechaActual = Carbon::now();
                            if($fechaActual->day === 15 && !$fechaActual->isWeekday()) {
                                // Si el día 15 no es hábil, se ajusta la fecha para el siguiente día hábil
                                $fechaActual = $fechaActual->nextWeekday();
                            }
                            return ($fechaActual->day === 15 || ($fechaActual->day === $fechaActual->endOfMonth()->day && $fechaActual->isWeekday()));
                        })
                        ->twiceMonthly(15, '08:00')
                        ->monthlyOn(date('t'), '08:00');

                // Enviar correo mensualmente el último día hábil del mes a las 8:00 am
                $schedule->command('enviar:formularios-carga')
                    ->monthlyOn(date('t'), '08:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
