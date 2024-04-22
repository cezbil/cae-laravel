<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Http\Requests\CaeRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class LoginUserRequest extends CaeRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|min:8'
        ];
    }
}
