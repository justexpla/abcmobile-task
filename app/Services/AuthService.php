<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\AuthServiceContract;
use App\Dto\RegisterUserDto;
use App\Mail\Auth\UserRegistered;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

        if ($sendEmail) {
            // @TODO Настроить отдельный контейнер под обработку очередей
            Mail::to($user->email)->queue(
                (new UserRegistered($user))
                    ->onQueue('send-email')
            );
        }

        return $user;
    }
}
