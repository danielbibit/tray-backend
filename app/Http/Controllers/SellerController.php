<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Services\SellerService;
use Exception;

class SellerController extends Controller
{
    public function __construct(
        private SellerService $sellerService
    )
    {

    }

    public function create(Request $request)
    {
        try {
            $seller = $this->sellerService->create($request->toArray());

            return response()->json($seller, 201);
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    public function index()
    {
        return $this->sellerService->getAll();
    }
    public function show($id)
    {
        try {
            $seller = $this->sellerService->getById($id);

            return response()->json($seller, 200);
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    public function getSales($id)
    {
        try {
            $sales = $this->sellerService->getSales($id);

            return response()->json($sales, 200);
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }
}
