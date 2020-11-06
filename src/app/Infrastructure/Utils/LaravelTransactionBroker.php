<?php

declare(strict_types=1);

namespace App\Infrastructure\Utils;

use App\Domain\Utils\Application\TransactionBroker;
use Closure;
use DB;

final class LaravelTransactionBroker implements TransactionBroker
{
    private bool $currentlyInTransaction = false;

    /**
     * @inheritDoc
     */
    public function transactional(callable $callable)
    {
        if ($this->currentlyInTransaction) {
            return $callable();
        }

        $this->currentlyInTransaction = true;

        try {
            return DB::transaction(Closure::fromCallable($callable));
        } finally {
            $this->currentlyInTransaction = false;
        }
    }
}
