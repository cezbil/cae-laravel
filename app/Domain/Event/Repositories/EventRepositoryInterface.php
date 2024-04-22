<?php

declare(strict_types=1);

namespace App\Domain\Event\Repositories;

use App\Domain\Event\Models\Event;

interface EventRepositoryInterface
{
    public function save(Event $event): void;
    public function findById(int $id): ?Event;
    public function findByDateRange(\DateTimeImmutable $start, \DateTimeImmutable $end): array;
    public function findFlightsNextWeek(): array;
    public function findStandByNextWeek(): array;
    public function findFlightsByStartLocation(string $startLocation): array;


}
