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
            Log::critical("Ipify service URL is not configured in config/services.php");
            return 'Configuration Error';
        }

        return Cache::remember('public_ip', 3600, function () {
            try {
                $response = Http::timeout(3)->retry(2, 100)->get($this->baseUrl);

                return $response->successful() ? $response->json('ip') : '0.0.0.0';
            } catch (\Exception $e) {
                Log::error("IP Service Failure: " . $e->getMessage());
                return '0.0.0.0';
            }
        });
    }
}
