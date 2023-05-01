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

                $schedule->command('enviar:formularios-carga')
                ->weeklyOn(1, '08:00');

                $schedule->command('enviar:formularios-carga')
                        ->monthlyOn(15, '08:00');

                $schedule->command('enviar:formularios-carga')
                        ->monthlyOn(16, '08:00');

                $schedule->command('enviar:formularios-carga')
                        ->monthlyOn(17, '08:00');

                $schedule->command('enviar:formularios-carga')
                        ->monthlyOn(CarbonImmutable::now()->endOfMonth()
                        ->day, '08:00');

                $schedule->command('enviar:formularios-carga')
                        ->monthlyOn(1, '08:00');

                $schedule->command('enviar:formularios-carga')
                        ->monthlyOn(2, '08:00');
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
