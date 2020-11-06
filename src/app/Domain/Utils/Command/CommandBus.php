<?php


namespace App\Domain\Utils\Command;


use Exception;

interface CommandBus
{
    /**
     * @throws Exception
     */
    public function dispatch(object $command): void;
}
