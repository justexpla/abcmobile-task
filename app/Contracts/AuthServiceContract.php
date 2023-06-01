<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Dto\RegisterUserDto;

interface AuthServiceContract
{
    public function registerUser(RegisterUserDto $dto);
}
