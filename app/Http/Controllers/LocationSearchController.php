<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocationSearchController extends Controller
{
    public function autocomplete(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:500',
            'lat' => 'nullable|numeric|between:-90,90',
            'lon' => 'nullable|numeric|between:-180,180',
        ]);

        $payload = [
            'text' => $validated['text'],
            'countryCode' => 'ID',
            'limit' => 10,
        ];

        if (isset($validated['lat'], $validated['lon'])) {
            $payload['focus'] = [
                'lat' => (float) $validated['lat'],
                'lon' => (float) $validated['lon'],
                'scaleKm' => 100,
            ];
        }

        $response = Http::withHeaders([
            'x-api-key' => config('services.opengeocoding.key'),
        ])->post(
            'https://api.opengeocoding.com/v1/autocomplete',
            $payload
        );

        return response()->json(
            $response->json() ?? ['message' => 'Location search failed'],
            $response->status()
        );
    }

    public function retrieve(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|max:256',
        ]);

        $response = Http::withHeaders([
            'x-api-key' => config('services.opengeocoding.key'),
        ])->post(
            'https://api.opengeocoding.com/v1/retrieve',
            ['id' => $validated['id']]
        );

        return response()->json(
            $response->json() ?? ['message' => 'Location retrieval failed'],
            $response->status()
        );
    }
}