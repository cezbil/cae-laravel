<?php

namespace App\Http\Requests\Event;

use App\Domain\Event\Exceptions\EventCreatedValidationFailedException;
use App\Http\Requests\CaeRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;

class FindFlightsByStartLocationRequest extends CaeRequest
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
            'startLocation' => 'required|string'
        ];
    }
}
