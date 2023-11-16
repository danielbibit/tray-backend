<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function __construct(
        private ReportService $reportService
    )
    {

    }

    public function adminReport(Request $request): array
    {
        return $this->reportService->adminReportData(date('Y-m-d'));
    }

    public function sellerReport(Request $request): array
    {
        $reportData = $this->reportService->sellerReportData($request['seller_id'], date('Y-m-d'));

        $this->reportService->sendSellerReport($reportData);

        return  $reportData;
    }
}
