<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\AuthServiceContract;
use App\Dto\RegisterUserDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class AuthService implements AuthServiceContract
{
    /**
     * @param RegisterUserDto $dto
     * @param bool $sendEmail
     * @return User
     */
    public function registerUser(RegisterUserDto $dto, bool $sendEmail = true): User
    {
        $user = new User();
        $user->email = $dto->email;
        $user->password = Hash::make($dto->password);

        $user->save();

        return $user;
    }
}
