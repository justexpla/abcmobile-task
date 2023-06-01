<?php

declare(strict_types=1);

namespace App\Dto;

class RegisterUserDto
{
    public string $email;

    public string $password;

    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): static
    {
        $dto = new static();
        $dto->email = $data['email'];
        $dto->password = $data['password'];

        return $dto;
    }
}
