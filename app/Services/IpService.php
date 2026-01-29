<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IpService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.ipify.url') ?? '';
    }

    public function getPublicIp(): string
    {
        if (empty($this->baseUrl)) {
            throw new \RuntimeException("Ipify service URL is not configured.");
        }

        return Cache::remember('public_ip', 3600, function () {
            try {
                $response = Http::timeout(3)->retry(2, 100)->get($this->baseUrl);

                if ($response->failed() || !$response->json('ip')) {
                    throw new \Exception("Invalid response from IP provider.");
                }

                return $response->json('ip');
            } catch (\Exception $e) {
                Log::error("IP Service Failure: " . $e->getMessage());
                throw new \RuntimeException("External IP service unavailable", 0, $e);
            }
        });
    }
}
