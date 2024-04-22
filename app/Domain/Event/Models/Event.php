<?php

declare(strict_types=1);

namespace App\Domain\Event\Models;

use App\Domain\Event\Enum\EventType;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'date',
        'revision',
        'duty_code',
        'check_in_local',
        'check_in_utc',
        'check_out_local',
        'check_out_utc',
        'activity',
        'remark',
        'from_station',
        'scheduled_time_departure_local',
        'scheduled_time_departure_utc',
        'to_station',
        'scheduled_time_arrival_local',
        'scheduled_time_arrival_utc',
        'aircraft_or_hotel',
        'block_hours',
        'flight_time',
        'night_time',
        'duration',
        'extras',
        'passengers_booked'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'check_in_local' => 'datetime',
        'check_in_utc' => 'datetime',
        'check_out_local' => 'datetime',
        'check_out_utc' => 'datetime',
        'scheduled_time_departure_local' => 'datetime',
        'scheduled_time_departure_utc' => 'datetime',
        'scheduled_time_arrival_local' => 'datetime',
        'scheduled_time_arrival_utc' => 'datetime'
    ];

    public function setActivityTypeAttribute($value): void
    {
        $this->attributes['activity_type'] = EventType::tryFrom($value) ?? EventType::Unknown;
    }
}
