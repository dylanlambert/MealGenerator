<?php

declare(strict_types=1);

namespace App\Domain\Utils\Application;

use Exception;

interface CommandBus
{
    /**
     * @throws Exception
     */
    public function dispatch(object $command): void;
}
