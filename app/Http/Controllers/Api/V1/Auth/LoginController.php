<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResponse;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Resources\Json\JsonResource;
use function auth;

final class LoginController extends BaseApiController
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse|JsonResource
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        if (auth()->attempt($credentials)) {;
            return AuthResponse::make(auth()->user());
        }

        return $this->unauthenticated();
    }

    public function me(): JsonResource
    {
        return UserResource::make(auth()->user());
    }

    public function refresh()
    {
        // @TODO: implement
    }

    public function logout()
    {
        // @TODO: implement
    }
}
