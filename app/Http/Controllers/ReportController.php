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

    public function adminReport(Request $request)
    {
        return $this->reportService->adminReportData(date('Y-m-d'));
    }
}
