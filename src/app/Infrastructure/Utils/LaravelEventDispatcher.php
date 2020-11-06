<?php

declare(strict_types=1);

namespace App\Infrastructure\Utils;

use App\Domain\Utils\Command\CommandBus;
use App\Domain\Utils\Command\TransactionBroker;

final class LaravelEventDispatcher implements CommandBus
{
    private TransactionBroker $transactionBroker;

    public function __construct(TransactionBroker $transactionBroker)
    {
        $this->transactionBroker = $transactionBroker;
    }

    public function dispatch(object $event): void
    {
        $this->transactionBroker->transactional(fn () => event($event));
    }
}
