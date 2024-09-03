<?php

namespace App\Services;

use App\Models\VehicleType;

class PriceCalculationService
{

    public function calculatePrices(float $totalDistance)
    {
        $vehicleTypes = VehicleType::all();


        $result = [];

        foreach ($vehicleTypes as $vehicleType) {
            $price = $totalDistance * $vehicleType->cost_km;

            if ($price < $vehicleType->minimum) {
                $price = $vehicleType->minimum;
            }

            $result[] = [
                'vehicle_type' => $vehicleType->number,
                'price' => round($price,2),
            ];
        }

        return $result;
    }
}
