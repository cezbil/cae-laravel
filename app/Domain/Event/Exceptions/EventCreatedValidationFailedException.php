<?php

declare(strict_types=1);

namespace App\Domain\Event\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;

class EventCreatedValidationFailedException extends HttpResponseException
{
}
