<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\PriceService;

class PriceController extends Controller
{
    public function __invoke(PriceService $price)
    {
        return response()->json($price->getPrice());
    }
}
