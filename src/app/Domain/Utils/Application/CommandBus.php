<?php


namespace App\Domain\Utils\Application;


use Exception;

interface CommandBus
{
    /**
     * @throws Exception
     */
    public function dispatch(object $command): void;
}
