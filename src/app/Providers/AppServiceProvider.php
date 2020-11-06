<?php

namespace App\Providers;

use App\Domain\Repositories\RecipeRepository;
use App\Domain\Utils\Command\CommandBus;
use App\Domain\Utils\Id\IdFactory;
use App\Domain\Utils\Command\TransactionBroker;
use App\Infrastructure\Repositories\EloquentRecipeRepository;
use App\Infrastructure\Utils\LaravelTransactionBroker;
use App\Infrastructure\Utils\LaravelEventDispatcher;
use App\Infrastructure\Utils\RamseyUuidFactory;
use Doctrine\DBAL\Types\Type;
use Illuminate\Support\ServiceProvider;
use Ramsey\Uuid\Doctrine\UuidType;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IdFactory::class, RamseyUuidFactory::class);
        $this->app->bind(TransactionBroker::class, LaravelTransactionBroker::class);
        $this->app->bind(CommandBus::class, LaravelEventDispatcher::class);

        $this->app->bind(RecipeRepository::class, EloquentRecipeRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!Type::hasType('uuid')) {
            Type::addType('uuid', UuidType::class);
        }
    }
}
