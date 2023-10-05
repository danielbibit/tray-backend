<?php

namespace App\Console;

use App\Mail\AdminSalesReport;
use App\Mail\SellerSalesReport;
use App\Repositories\SaleRepository;
use App\Repositories\SellerRepository;
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
    protected $sellerRepository;

    public function __construct(
        Application $app,
        Dispatcher $events,
        ReportService $reportService,
        SellerRepository $sellerRepository
    )
    {
        $this->reportService = $reportService;
        $this->sellerRepository = $sellerRepository;

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

            // TODO use yesterdays date
            $reportData = $this->reportService->adminReportData(date('Y-m-d'));

            Mail::to(env('ADMIN_EMAIL'))->send(new AdminSalesReport($reportData));
        })->dailyAt('00:01');

        //Daily seller sales report
        $schedule->call(function() {
            Log::debug('Seller report schedule called');

            $sellers = $this->sellerRepository->getAll();

            foreach($sellers as &$seller) {
                $reportData = $this->reportService->sellerReportData($seller['id'], date('Y-m-d'));

                Log::debug($reportData);

                Mail::to($seller['email'])->send(new SellerSalesReport($reportData));
            }


            Log::debug($sellers);

        })->dailyAt('00:01');
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
