<?php

namespace App\Http\Requests\Event;

use App\Domain\Event\Exceptions\EventCreatedValidationFailedException;
use App\Http\Requests\CaeRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;

class CreateEventRequest extends CaeRequest
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
            'date' => 'required|date',
            'revision' => 'nullable|string|max:10',
            'dutyCode' => 'nullable|string|max:10',
            'checkInLocalTime' => 'nullable|date_format:H:i',
            'checkInZuluTime' => 'nullable|date_format:H:i',
            'checkOutLocalTime' => 'nullable|date_format:H:i',
            'checkOutZuluTime' => 'nullable|date_format:H:i',
            'activityType' => 'required|string|max:10',
            'activityRemark' => 'nullable|string|max:255',
            'fromStation' => 'nullable|string|max:10',
            'stdLocalTime' => 'nullable|date_format:H:i',
            'stdZuluTime' => 'nullable|date_format:H:i',
            'toStation' => 'nullable|string|max:10',
            'staLocalTime' => 'nullable|date_format:H:i',
            'staZuluTime' => 'nullable|date_format:H:i',
            'aircraftOrHotel' => 'nullable|string|max:50',
            'blockHours' => 'nullable|date_format:H:i',
            'flightTime' => 'nullable|date_format:H:i',
            'nightTime' => 'nullable|date_format:H:i',
            'duration' => 'nullable|date_format:H:i',
            'extraDetails' => 'nullable|string|max:255'
        ];
    }
    protected function failedValidation(Validator $validator): void
    {
        throw new EventCreatedValidationFailedException(response()->json(['errors' => $validator->errors()], 422));
    }
}
