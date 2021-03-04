<?php

namespace App\Providers;

use App\Domain\Repositories\HistoricRepository;
use App\Domain\Repositories\IngredientRepository;
use App\Domain\Repositories\RecipeRepository;
use App\Domain\Repositories\UserRepository;
use App\Domain\Utils\Application\CommandBus;
use App\Domain\Utils\Id\Id;
use App\Domain\Utils\Id\IdFactory;
use App\Domain\Utils\Application\TransactionBroker;
use App\Infrastructure\Repositories\EloquentHistoricRepository;
use App\Infrastructure\Repositories\EloquentIngredientRepository;
use App\Infrastructure\Repositories\EloquentRecipeRepository;
use App\Infrastructure\Repositories\EloquentUserRepository;
use App\Infrastructure\Utils\LaravelTransactionBroker;
use App\Infrastructure\Utils\LaravelEventDispatcher;
use App\Infrastructure\Utils\RamseyUuidFactory;
use App\Infrastructure\Utils\Uuid;
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
        $this->app->bind(IngredientRepository::class, EloquentIngredientRepository::class);
        $this->app->bind(HistoricRepository::class, EloquentHistoricRepository::class);
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
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
