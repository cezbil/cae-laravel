<?php
declare(strict_types=1);

namespace App\Http\Requests\Event;

use App\Domain\Event\Exceptions\EventCreatedValidationFailedException;
use App\Http\Requests\CaeRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;

class CreateEventsFromHtmlRequest extends CaeRequest
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
            'html_file' => ['required', 'file', 'mimes:html', 'max:5120'], // Accepts only HTML files up to 5 MB
        ];
    }
    protected function failedValidation(Validator $validator): void
    {
        throw new EventCreatedValidationFailedException(response()->json(['errors' => $validator->errors()], 422));
    }
}
