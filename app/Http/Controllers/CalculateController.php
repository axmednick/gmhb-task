<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculatePriceRequest;
use App\Http\Resources\VehiclePriceResource;
use App\Services\GoogleService;
use App\Services\PriceCalculationService;
use Illuminate\Http\Request;

class CalculateController extends Controller
{

    public function __construct(
        protected  GoogleService $googleService,
        protected PriceCalculationService $priceCalculationService
    )
    {
    }

    public function calculate(CalculatePriceRequest $request)
    {
        $totalDistance = $this->googleService->getDistance($request->addresses);
        $prices = $this->priceCalculationService->calculatePrices($totalDistance);

        return VehiclePriceResource::collection(collect($prices));


    }
}
