<?php

declare(strict_types=1);

namespace App\Domain\Event\Command\CreateEvent;

use App\Domain\Bus\Command\Command;

class CreateEvent extends Command
{
    public function __construct(
        public string $date,
        public ?string $revision,
        public string $dutyCode,
        public ?string $checkInLocalTime,
        public ?string $checkInZuluTime,
        public ?string $checkOutLocalTime,
        public ?string $checkOutZuluTime,
        public string $activityType,
        public ?string $activityRemark,
        public string $fromStation,
        public ?string $stdLocalTime,
        public ?string $stdZuluTime,
        public string $toStation,
        public ?string $staLocalTime,
        public ?string $staZuluTime,
        public ?string $aircraftOrHotel,
        public ?string $blockHours,
        public ?string $flightTime,
        public ?string $nightTime,
        public ?string $duration,
        public ?string $extraDetails
    ) {
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getRevision(): ?string
    {
        return $this->revision;
    }

    public function setRevision(?string $revision): void
    {
        $this->revision = $revision;
    }

    public function getDutyCode(): string
    {
        return $this->dutyCode;
    }

    public function setDutyCode(string $dutyCode): void
    {
        $this->dutyCode = $dutyCode;
    }

    public function getCheckInLocalTime(): ?string
    {
        return $this->checkInLocalTime;
    }

    public function setCheckInLocalTime(?string $checkInLocalTime): void
    {
        $this->checkInLocalTime = $checkInLocalTime;
    }

    public function getCheckInZuluTime(): ?string
    {
        return $this->checkInZuluTime;
    }

    public function setCheckInZuluTime(?string $checkInZuluTime): void
    {
        $this->checkInZuluTime = $checkInZuluTime;
    }

    public function getCheckOutLocalTime(): ?string
    {
        return $this->checkOutLocalTime;
    }

    public function setCheckOutLocalTime(?string $checkOutLocalTime): void
    {
        $this->checkOutLocalTime = $checkOutLocalTime;
    }

    public function getCheckOutZuluTime(): ?string
    {
        return $this->checkOutZuluTime;
    }

    public function setCheckOutZuluTime(?string $checkOutZuluTime): void
    {
        $this->checkOutZuluTime = $checkOutZuluTime;
    }

    public function getActivityType(): string
    {
        return $this->activityType;
    }

    public function setActivityType(string $activityType): void
    {
        $this->activityType = $activityType;
    }

    public function getActivityRemark(): ?string
    {
        return $this->activityRemark;
    }

    public function setActivityRemark(?string $activityRemark): void
    {
        $this->activityRemark = $activityRemark;
    }

    public function getFromStation(): string
    {
        return $this->fromStation;
    }

    public function setFromStation(string $fromStation): void
    {
        $this->fromStation = $fromStation;
    }

    public function getStdLocalTime(): ?string
    {
        return $this->stdLocalTime;
    }

    public function setStdLocalTime(?string $stdLocalTime): void
    {
        $this->stdLocalTime = $stdLocalTime;
    }

    public function getStdZuluTime(): ?string
    {
        return $this->stdZuluTime;
    }

    public function setStdZuluTime(?string $stdZuluTime): void
    {
        $this->stdZuluTime = $stdZuluTime;
    }

    public function getToStation(): string
    {
        return $this->toStation;
    }

    public function setToStation(string $toStation): void
    {
        $this->toStation = $toStation;
    }

    public function getStaLocalTime(): ?string
    {
        return $this->staLocalTime;
    }

    public function setStaLocalTime(?string $staLocalTime): void
    {
        $this->staLocalTime = $staLocalTime;
    }

    public function getStaZuluTime(): ?string
    {
        return $this->staZuluTime;
    }

    public function setStaZuluTime(?string $staZuluTime): void
    {
        $this->staZuluTime = $staZuluTime;
    }

    public function getAircraftOrHotel(): ?string
    {
        return $this->aircraftOrHotel;
    }

    public function setAircraftOrHotel(?string $aircraftOrHotel): void
    {
        $this->aircraftOrHotel = $aircraftOrHotel;
    }

    public function getBlockHours(): ?string
    {
        return $this->blockHours;
    }

    public function setBlockHours(?string $blockHours): void
    {
        $this->blockHours = $blockHours;
    }

    public function getFlightTime(): ?string
    {
        return $this->flightTime;
    }

    public function setFlightTime(?string $flightTime): void
    {
        $this->flightTime = $flightTime;
    }

    public function getNightTime(): ?string
    {
        return $this->nightTime;
    }

    public function setNightTime(?string $nightTime): void
    {
        $this->nightTime = $nightTime;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration): void
    {
        $this->duration = $duration;
    }

    public function getExtraDetails(): ?string
    {
        return $this->extraDetails;
    }

    public function setExtraDetails(?string $extraDetails): void
    {
        $this->extraDetails = $extraDetails;
    }
}
