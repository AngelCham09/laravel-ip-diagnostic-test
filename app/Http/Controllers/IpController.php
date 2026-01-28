<?php

namespace App\Http\Controllers;

use App\Services\IpService;
use Illuminate\Http\JsonResponse;

class IpController extends Controller
{
    public function __construct(
        protected IpService $ipService
    ) {}

    public function show(): JsonResponse
    {
        $ip = $this->ipService->getPublicIp();

        return response()->json([
            'ip' => $ip,
            'status' => $ip === '0.0.0.0' ? 'error' : 'success',
        ]);
    }
}
