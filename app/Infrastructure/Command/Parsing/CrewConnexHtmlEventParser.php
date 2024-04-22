<?php

declare(strict_types=1);

namespace App\Infrastructure\Command\Parsing;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Services\Command\Interfaces\HtmlEventParserInterface;
use Illuminate\Http\UploadedFile;
use Symfony\Component\DomCrawler\Crawler;

class CrewConnexHtmlEventParser implements HtmlEventParserInterface
{
    public const START_DATE = '14/01/2022';
    public const CURRENT_MONTH = '01';
    public const CURRENT_YEAR = '2022';
    /**
     * @inheritDoc
     */
    public function parse(UploadedFile $html): array
    {
        $htmlString = $html->getContent();
        if (empty($htmlString)) {
            throw new \RuntimeException("No content in file");
        }

        $crawler = new Crawler($htmlString);
        $events = [];
        $lastKnownDate = null;

        $crawler->filter('#ctl00_Main_activityGrid tr')->each(function (Crawler $node) use (&$events, &$lastKnownDate) {
            if ($node->attr('class') !== 'activity-table-header' && $node->filter('td')->count() > 0) {
                $cells = $node->filter('td')->each(function (Crawler $cell) {
                    return trim($cell->text());
                });

                if (!empty($cells[1]) && preg_match('/\bMon\b|\bTue\b|\bWed\b|\bThu\b|\bFri\b|\bSat\b|\bSun\b/', $cells[1])) {
                    $lastKnownDate = $cells[1];
                    $lastKnownDate = explode(" ", $lastKnownDate)[1];
                }

                $event = new Event([
                    'date' => $this->parseDateTime(self::CURRENT_YEAR . self::CURRENT_MONTH . $lastKnownDate),
                    'revision' => $cells[2] ?? null,
                    'duty_code' => $cells[3] ?? null,
                    'check_in_local' => $this->parseDateTime(self::CURRENT_YEAR . self::CURRENT_MONTH . $lastKnownDate . $cells[4], "Europe/Warsaw"),
                    'check_in_utc' => $this->parseDateTime(self::CURRENT_YEAR . self::CURRENT_MONTH . $lastKnownDate . $cells[5]),
                    'check_out_local' => $this->parseDateTime(self::CURRENT_YEAR . self::CURRENT_MONTH . $lastKnownDate . $cells[6], "Europe/Warsaw"),
                    'check_out_utc' => $this->parseDateTime(self::CURRENT_YEAR . self::CURRENT_MONTH . $lastKnownDate . $cells[7]),
                    'activity' => $cells[8] ?? null,
                    'remark' => $cells[9] ?? null,
                    'from_station' => $cells[11] ?? null,
                    'scheduled_time_departure_local' => $this->parseDateTime(self::CURRENT_YEAR . self::CURRENT_MONTH . $lastKnownDate . $cells[12], "Europe/Warsaw"),
                    'scheduled_time_departure_utc' => $this->parseDateTime(self::CURRENT_YEAR . self::CURRENT_MONTH . $lastKnownDate . $cells[13]),
                    'to_station' => $cells[15] ?? null,
                    'scheduled_time_arrival_local' => $this->parseDateTime(self::CURRENT_YEAR . self::CURRENT_MONTH . $lastKnownDate . $cells[16], "Europe/Warsaw"),
                    'scheduled_time_arrival_utc' => $this->parseDateTime(self::CURRENT_YEAR . self::CURRENT_MONTH . $lastKnownDate . $cells[13]),
                    'aircraft_or_hotel' => $cells[19] ?? null,
                    'block_hours' => $cells[20] ?? null,
                    'flight_time' => $cells[21] ?? null,
                    'night_time' => $cells[22] ?? null,
                    'duration' => $cells[23] ?? null,
                    'extras' => $cells[24] ?? null,
                    'tail_number' => $cells[27] ?? null,
                    'crew_meal' => $cells[28] ?? null,
                    'crew_code_list' => $cells[31] ?? null,
                    'position_list' => $cells[33] ?? null,
                    'other_dh_crew_code' => $cells[35] ?? null,
                    'remarks' => $cells[38] ?? null,
                    'actual_fdp_time' => $cells[39] ?? null,
                    'max_fdp_time' => $cells[40] ?? null
                ]);

                $events[] = $event;
            }
        });

        if (empty($events)) {
            throw new \RuntimeException("No events found");
        }

        return $events;
    }
    public function parseDateTime(string $dateTime, string $timezone = 'UTC'): \DateTime
    {
        try {
            $dateTime = str_replace("-1", "", $dateTime); // I am not sure what -1 is supposed to be doing, I removed it for now
            return new \DateTime($dateTime, new \DateTimeZone($timezone));
        } catch (\Exception $e) {
            throw new \RuntimeException("Invalid date time format: {$dateTime}");
        }
    }
}
