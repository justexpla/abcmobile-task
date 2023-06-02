<?php

namespace App\Http\Requests;

use App\Rules\SupportedLang;

final class UpdateSettingsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'timezone' => ['required', 'timezone:all'],
            'language' => ['required', 'string', new SupportedLang()]
        ];
    }
}
