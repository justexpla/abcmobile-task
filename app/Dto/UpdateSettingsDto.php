<?php

declare(strict_types=1);

namespace App\Dto;

class UpdateSettingsDto
{
    public string $timezone;

    public string $lang;

    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): static
    {
        $dto = new static();
        $dto->lang = $data['language'];
        $dto->timezone = $data['timezone'];

        return $dto;
    }
}
