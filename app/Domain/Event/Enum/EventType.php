<?php

declare(strict_types=1);

namespace App\Domain\Event\Enum;

enum EventType: string
{
    case Flight = 'FLT';
    case DayOff = 'DO';
    case Standby = 'SBY';
    case CheckIn = 'CI';
    case CheckOut = 'CO';
    case Unknown = 'UNK';
}
