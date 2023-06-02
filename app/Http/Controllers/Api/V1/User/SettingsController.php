<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User;

use App\Dto\UpdateSettingsDto;
use App\Http\Requests\UpdateSettingsRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

use function auth;

final class SettingsController
{
    public function __construct(
        private UserService $userService
    ) {}

    public function update(UpdateSettingsRequest $request)
    {
        $updateDto = UpdateSettingsDto::fromArray($request->validated());

        $user = $this->userService->updateSettings(auth()->user(), $updateDto);

        return UserResource::make($user);
    }
}
