<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Contracts\AuthServiceContract;
use App\Dto\RegisterUserDto;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResponse;
use Illuminate\Http\Resources\Json\JsonResource;

final class RegisterController extends BaseApiController
{
    public function __construct(
        private AuthServiceContract $authService
    ) {}

    public function register(RegisterRequest $request): JsonResource
    {
        $registerDto = RegisterUserDto::fromArray($request->validated());

        $user = $this->authService->registerUser($registerDto);

        return AuthResponse::make($user);
    }
}
