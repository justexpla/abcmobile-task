<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\UpdateSettingsDto;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

final class UserService
{
    /**
     * @param Authenticatable $user
     * @param UpdateSettingsDto $dto
     * @return User
     */
    public function updateSettings(User $user, UpdateSettingsDto $dto): User
    {
        $user->timezone = $dto->timezone;
        $user->lang = $dto->lang;
        $user->save();

        return $user->fresh();
    }
}
