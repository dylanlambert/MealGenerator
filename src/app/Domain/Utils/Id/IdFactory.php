<?php

declare(strict_types=1);

namespace App\Domain\Utils\Id;

interface IdFactory
{
    public function generateId(): Id;
}
