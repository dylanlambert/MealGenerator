<?php

declare(strict_types=1);

namespace App\Domain\Utils\PreparationTime;

final class PreparationTime
{
    private int $time;

    public function __construct(int $time)
    {
        $this->time = $time;
    }

    public function getFormattedPreparationTime(): string
    {
        return $this->time / 60 . ' minutes';
    }

    public function getSeconds(): int
    {
        return $this->time;
    }

    public function under(self $that): bool
    {
        return  $this->time <= $that->time;
    }
}
