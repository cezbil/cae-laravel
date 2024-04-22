<?php

namespace Event\Repository;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Repositories\EventRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventRepositoryTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow(Carbon::create(2022, 1, 14));
    }

    public function testFindFlightsNextWeek()
    {
        $sampleEvent = Event::create([
            'activity' => 'DX123',
            'date' => '2022-01-21',
            'from_station' => 'JFK'
        ]);

        $repository = new EventRepository();
        $results = $repository->findFlightsNextWeek();

        $this->assertCount(1, $results);
        $this->assertEquals('DX123', $results[0]->activity);
    }

    public function testFindStandByNextWeek()
    {
        Event::create([
            'activity' => 'SBY',
            'date' => '2022-01-21'
        ]);

        $repository = new EventRepository();
        $results = $repository->findStandByNextWeek();

        $this->assertCount(1, $results);
        $this->assertEquals('SBY', $results[0]->activity);
    }

    public function testFindFlightsByStartLocation()
    {
        Event::create([
            'activity' => 'DX123',
            'from_station' => 'JFK',
            'date' => '2022-01-21'
        ]);

        $repository = new EventRepository();
        $results = $repository->findFlightsByStartLocation('JFK');

        $this->assertCount(1, $results);
        $this->assertEquals('DX123', $results[0]->activity);
    }
    public function testFindByDateRange()
    {
        $event1 = Event::create([
            'activity' => 'Flight DX123',
            'date' => '2022-01-15',
        ]);

        $event2 = Event::create([
            'activity' => 'Flight DX124',
            'date' => '2022-01-20',
        ]);

        $event3 = Event::create([
            'activity' => 'Flight DX125',
            'date' => '2022-01-25',
        ]);

        $repository = new EventRepository();
        $results = $repository->findByDateRange(new \DateTimeImmutable('2022-01-15'), new \DateTimeImmutable('2022-01-20'));

        $this->assertCount(2, $results);
        $this->assertInstanceOf(Event::class, $results[0]);
        $this->assertInstanceOf(Event::class, $results[1]);
    }
    public function testSave()
    {
        $event = new Event([
            'activity' => 'Flight DX999',
            'date' => '2022-01-22',
        ]);

        $repository = new EventRepository();
        $repository->save($event);

        $persistedEvent = Event::find($event->id);
        $this->assertNotNull($persistedEvent);
        $this->assertEquals('Flight DX999', $persistedEvent->activity);

        $persistedEvent->activity = 'Flight DX1000';

        $repository->save($persistedEvent);

        $updatedEvent = Event::find($persistedEvent->id);
        $this->assertEquals('Flight DX1000', $updatedEvent->activity);
    }
    public function testFindById()
    {
        $event = Event::create([
            'activity' => 'Flight DX123',
            'date' => '2022-01-21',
        ]);

        $repository = new EventRepository();
        $foundEvent = $repository->findById($event->id);

        $this->assertNotNull($foundEvent);
        $this->assertEquals($event->id, $foundEvent->id);
        $this->assertEquals('Flight DX123', $foundEvent->activity);

        $nonExistentEvent = $repository->findById(999);

        $this->assertNull($nonExistentEvent);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Carbon::setTestNow();
    }
}
