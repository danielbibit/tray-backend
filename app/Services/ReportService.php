<?php
namespace App\Services;

use App\Models\Sale;
use App\Repositories\SaleRepository;
use ErrorException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ReportService
{

    public function __construct(
        private SaleRepository $saleRepository)
    {
    }

    public function adminReportData($date)
    {
        $sales = $this->saleRepository->getSalesByDate($date);

        $totalSold = 0.0;

        foreach($sales as &$sale) {
            Log::debug($sale);
            $totalSold += $sale['price'];
        }

        Log::debug($totalSold);

        $data = [
            'total_sold' => $totalSold
        ];

        return $data;
    }

}
