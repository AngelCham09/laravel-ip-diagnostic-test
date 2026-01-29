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
        try {
            return response()->json([
                'ip' => $this->ipService->getPublicIp(),
                'status' => 'success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Service Unavailable',
                'status' => 'error'
            ], 503);
        }
    }
}
