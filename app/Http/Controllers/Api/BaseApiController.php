<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

use function response;

class BaseApiController extends Controller
{
    public function unauthenticated(): JsonResponse
    {
        return response()->json(['error' => 'Unauthenticated'])
            ->setStatusCode(401);
    }
}
