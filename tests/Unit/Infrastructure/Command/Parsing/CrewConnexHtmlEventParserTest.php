<?php

namespace Infrastructure\Command\Parsing;

use App\Domain\Event\Models\Event;
use App\Infrastructure\Command\Parsing\CrewConnexHtmlEventParser;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\CreatesApplication;

class CrewConnexHtmlEventParserTest extends BaseTestCase
{
    use CreatesApplication;

    public function testItParsesHtmlIntoEventObjects(): void
    {
        $uploadedFile = new UploadedFile(
            path: __DIR__ . '/Resources/sample.html',
            originalName: 'sample.html',
            mimeType: 'text/html',
            error: null,
            test: true
        );

        $parser = new CrewConnexHtmlEventParser();
        $events = $parser->parse($uploadedFile);

        $this->assertIsArray($events);
        $this->assertInstanceOf(Event::class, $events[0]);
        $this->assertCount(35, $events);
        $this->assertEquals('2022-01-10', $events[0]->date->format('Y-m-d'));
    }
    public function testItThrowsExceptionWhenNoEventsFound(): void
    {
        $uploadedFile = new UploadedFile(
            path: __DIR__ . '/Resources/sample-empty.html',
            originalName: 'sample-empty.html',
            mimeType: 'text/html',
            error: null,
            test: true
        );

        $parser = new CrewConnexHtmlEventParser();

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage("No events found");

        $parser->parse($uploadedFile);
    }
    public function testItThrowsExceptionForInvalidDateFormat()
    {

        $uploadedFile = new UploadedFile(
            path: __DIR__ . '/Resources/sample-malformed-time.html',
            originalName: 'sample-malformed-time.html',
            mimeType: 'text/html',
            error: null,
            test: true
        );

        $parser = new CrewConnexHtmlEventParser();

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageMatches('/Invalid date time format:/');

        $parser->parse($uploadedFile);
    }
    public function testItThrowsExceptionNoContentRuntimeException(): void
    {

        $uploadedFile = new UploadedFile(
            path: __DIR__ . '/Resources/nothing.html',
            originalName: 'nothing.html',
            mimeType: 'text/html',
            error: null,
            test: true
        );

        $parser = new CrewConnexHtmlEventParser();

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageMatches('/No content in file/');

        $parser->parse($uploadedFile);
    }

}
