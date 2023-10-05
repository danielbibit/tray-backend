<?php
namespace App\Services;

use App\Mail\SellerSalesReport;
use App\Models\Sale;
use App\Repositories\SaleRepository;
use App\Repositories\SellerRepository;
use ErrorException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReportService
{

    public function __construct(
        private SaleRepository $saleRepository,
        private SellerRepository $sellerRepository
    )
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

    public function sellerReportData($seller_id, $date)
    {
        $seller = $this->sellerRepository->getById($seller_id);

        $sales = $seller->sales()->whereDate('sale_date', $date)->get();

        Log::debug($sales);

        $reportData = [
            "seller_name" => $seller['name'],
            "seller_email" => $seller['email'],
            "number_of_sales" => 0,
            "total_sales" => 0.0,
            "total_comission" => 0.0,
        ];

        foreach($sales as &$sale) {
            $reportData['number_of_sales'] += 1;
            $reportData['total_sales'] += $sale['price'];
            $reportData['total_comission'] += $sale['comission'];
        }

        Log::debug($reportData);

        return $reportData;
    }

    public function sendSellerReport($sellerReportData)
    {
        Mail::to($sellerReportData['seller_email'])->send(new SellerSalesReport($sellerReportData));
    }

}
