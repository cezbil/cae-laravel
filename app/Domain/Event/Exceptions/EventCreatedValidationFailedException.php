<?php
declare(strict_types=1);

namespace App\Domain\Event\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class EventCreatedValidationFailedException extends HttpResponseException
{
}
