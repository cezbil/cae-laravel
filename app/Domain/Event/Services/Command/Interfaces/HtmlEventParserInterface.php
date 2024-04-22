<?php

namespace App\Domain\Event\Services\Command\Interfaces;

use App\Domain\Event\Models\Event;
use Illuminate\Http\UploadedFile;

interface HtmlEventParserInterface
{
    /**
     * Parse HTML content into an array of Event objects.
     *
     * @param UploadedFile $html The HTML content to parse.
     * @return array<Event>
     */
    public function parse(UploadedFile $html): array;
}
