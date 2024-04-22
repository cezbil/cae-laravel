<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\CaeRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class FindEventsByDateRangeRequest extends CaeRequest
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
            'startDate' => 'required|date',
            'endDate' => 'required|date'
        ];
    }
}
