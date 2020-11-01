<?php


namespace App\Domain\Utils;


use Exception;

interface CommandBus
{
    /**
     * @throws Exception
     */
    public function dispatch(object $command): void;
}
