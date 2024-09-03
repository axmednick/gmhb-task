<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.google_maps.api_key');
    }

    public function getDistance(array $addresses)
    {
        $totalDistance = 0;
        $previousLocation = null;

        foreach ($addresses as $address) {
            if ($previousLocation) {
                $origin = $previousLocation['city'] . ',' . $previousLocation['zip'] . ',' . $previousLocation['country'];
                $destination = $address['city'] . ',' . $address['zip'] . ',' . $address['country'];

                $response = Http::get('https://maps.googleapis.com/maps/api/directions/json', [
                    'origin' => $origin,
                    'destination' => $destination,
                    'key' => $this->apiKey,
                ]);

                $distanceValue = $response->json('routes.0.legs.0.distance.value');
                $totalDistance += $distanceValue;
            }

            $previousLocation = $address;
        }

        return $totalDistance;
    }

}
