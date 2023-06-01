<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Практически во всех своих проектах я делаю базовый FormRequest контроллер, в котором переопределяю метод authorize,
 * т.к. по умолчанию этот класс несет 2 ответственности - валидация и авторизация, что не соотвествует Solid.
 * Для авторизации у laravel есть механизмы Guard и Policy, они более гибкие.
 *
 * Class BaseRequest
 * @package App\Http\Requests
 */
abstract class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    abstract public function rules(): array;
}
