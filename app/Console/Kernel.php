<?php

namespace App\Console;

use App\Mail\DespachoCarga\NotificacionCarga;
use App\Models\Carga;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
                    ->dailyAt('23:59');

                // Enviar correo semanalmente los lunes a las 8:00 am
                $schedule->command('enviar:formularios-carga')
                ->weeklyOn(1, '8:00');

                // Enviar correo quincenalmente los días 15 y último día hábil del mes
                $schedule->command('enviar:formularios-carga')
                ->monthlyOn(15, '08:00')
                ->when(function () {
                   $fechaActual = CarbonImmutable::now(); // Obtiene la fecha y hora actual

                   // Verifica si es el 15 o un día hábil posterior al 15
                   if ($fechaActual->day >= 15 && $fechaActual->isWeekday()) {
                       return true;
                   } elseif ($fechaActual->day < 15) {
                       $siguienteDiaHabil = $fechaActual->nextWeekday();
                       if ($siguienteDiaHabil->day === 15) {
                           return true;
                       }
                   }
                   return false;
               });
                // Enviar correo mensualmente el último día hábil del mes a las 8:00 am si este último día cae en un día no hábil se enviará el día hábil siguiente al último día del mes
                $schedule->command('enviar:formularios-carga')
                ->monthlyOn('L', '08:00')
                ->when(function () {
                    $fechaActual = CarbonImmutable::now(); // Obtiene la fecha y hora actual
                    $ultimoDiaMes = $fechaActual->endOfMonth()->dayOfWeek === CarbonImmutable::SUNDAY
                        ? $fechaActual->endOfMonth()->nextWeekday()
                        : $fechaActual->endOfMonth();

                    // Verifica si es el último día del mes o un día hábil posterior al último día del mes
                    if ($fechaActual->equalTo($ultimoDiaMes) || $fechaActual->isAfter($ultimoDiaMes)) {
                        return true;
                    }
                    return false;
                });
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
