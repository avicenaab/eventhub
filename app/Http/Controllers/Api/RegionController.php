<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ApiIndonesiaService;
use Illuminate\Http\JsonResponse;
use Throwable;

class RegionController extends Controller
{
    public function __construct(private readonly ApiIndonesiaService $regions)
    {
    }

    private function respond(callable $callback): JsonResponse
    {
        try {
            return response()->json(['success' => true, 'data' => $callback()]);
        } catch (Throwable $exception) {
            report($exception);

            return response()->json([
                'success' => false,
                'message' => app()->environment('production')
                    ? 'Data wilayah sedang tidak dapat diakses. Silakan coba lagi.'
                    : $exception->getMessage(),
            ], 503);
        }
    }

    public function provinces(): JsonResponse
    {
        return $this->respond(fn () => $this->regions->provinces());
    }

    public function regencies(string $province): JsonResponse
    {
        return $this->respond(fn () => $this->regions->regencies($province));
    }

    public function districts(string $regency): JsonResponse
    {
        return $this->respond(fn () => $this->regions->districts($regency));
    }

    public function villages(string $district): JsonResponse
    {
        return $this->respond(fn () => $this->regions->villages($district));
    }
}
