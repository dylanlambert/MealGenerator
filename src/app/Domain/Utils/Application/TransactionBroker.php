<?php


namespace App\Domain\Utils\Application;


interface TransactionBroker
{
    /**
     * @template T
     * @param callable():T $callable
     * @return mixed
     * @phpstan-return T
     */
    public function transactional(callable $callable);
}
