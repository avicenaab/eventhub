<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class ApiIndonesiaService
{
    private function get(string $path, array $query = []): array
    {
        $key = config('services.api_indonesia.key');
        $baseUrl = rtrim(config('services.api_indonesia.base_url', 'https://use.apiindonesia.id'), '/');

        if (!$key) {
            throw new RuntimeException('API key API Indonesia belum diatur. Tambahkan API_INDONESIA_KEY di file .env.');
        }

        $cacheKey = 'api_indonesia:' . sha1($path . '?' . http_build_query($query));

        return Cache::remember($cacheKey, now()->addHours(12), function () use ($baseUrl, $path, $query, $key) {
            $response = Http::acceptJson()
                ->withHeaders(['x-api-key' => $key])
                ->timeout(15)
                ->retry(2, 300)
                ->get($baseUrl . $path, $query);

            if (!$response->successful()) {
                throw new RuntimeException('API Indonesia mengembalikan HTTP ' . $response->status() . '.');
            }

            $payload = $response->json();
            if (!is_array($payload) || !isset($payload['data']) || !is_array($payload['data'])) {
                throw new RuntimeException('Format respons API Wilayah tidak sesuai dokumentasi.');
            }

            return $payload['data'];
        });
    }

    public function provinces(): array
    {
        return $this->get('/api/v1/wilayah/provinsi', ['page' => 1, 'per_page' => 100]);
    }

    public function regencies(string $provinceId): array
    {
        return $this->get('/api/v1/wilayah/provinsi/' . rawurlencode($provinceId) . '/kabupaten', ['page' => 1, 'per_page' => 100]);
    }

    public function districts(string $regencyId): array
    {
        return $this->get('/api/v1/wilayah/kabupaten/' . rawurlencode($regencyId) . '/kecamatan', ['page' => 1, 'per_page' => 100]);
    }

    public function villages(string $districtId): array
    {
        return $this->get('/api/v1/wilayah/kecamatan/' . rawurlencode($districtId) . '/kelurahan', ['page' => 1, 'per_page' => 100]);
    }
}
