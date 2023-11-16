<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SaleService;
use Exception;
use Illuminate\Http\JsonResponse;

class SaleController extends Controller
{
    public function __construct(
        private SaleService $saleService
    )
    {

    }

    public function create(Request $request): JsonResponse
    {
        try {
            $sale = $this->saleService->create($request->toArray());

            return response()->json($sale, 201);
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    public function index(): JsonResponse
    {
        $sales = $this->saleService->getAll();

        return response()->json($sales, 200);
    }
}
