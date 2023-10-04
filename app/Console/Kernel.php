<?php

namespace App\Console;

use App\Mail\AdminSalesReport;
use App\Services\ReportService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Log;

// use Symfony\Component\Console\Application;
// use Illuminate\Bus\Dispatcher;

class Kernel extends ConsoleKernel
{
    protected $reportService;

    public function __construct(
        Application $app,
        Dispatcher $events,
        ReportService $reportService
    )
    {
        $this->reportService = $reportService;
        parent::__construct($app, $events);
    }
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        //Daily admin sales report
        $schedule->call(function() {
            Log::debug('Admin report schedule called');

            $reportData = $this->reportService->adminReportData(date('Y-m-d'));

            Mail::to(env('ADMIN_EMAIL'))->send(new AdminSalesReport($reportData));
        // })->dailyAt('00:01');
        })->everyMinute()->appendOutputTo(storage_path('logs/laravel.log'));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
