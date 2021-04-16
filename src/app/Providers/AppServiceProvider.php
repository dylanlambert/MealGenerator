<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domain\Repositories\IngredientRepository;
use App\Domain\Repositories\RecipeRepository;
use App\Domain\Repositories\UserRepository;
use App\Domain\Utils\Application\CommandBus;
use App\Domain\Utils\Id\IdFactory;
use App\Domain\Utils\Application\TransactionBroker;
use App\Infrastructure\Repositories\EloquentIngredientRepository;
use App\Infrastructure\Repositories\EloquentRecipeRepository;
use App\Infrastructure\Repositories\EloquentUserRepository;
use App\Infrastructure\Utils\LaravelTransactionBroker;
use App\Infrastructure\Utils\LaravelEventDispatcher;
use App\Infrastructure\Utils\RamseyUuidFactory;
use Doctrine\DBAL\Types\Type;
use Illuminate\Support\ServiceProvider;
use Ramsey\Uuid\Doctrine\UuidType;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     */
    public function register(): void
    {
        $this->app->bind(IdFactory::class, RamseyUuidFactory::class);
        $this->app->bind(TransactionBroker::class, LaravelTransactionBroker::class);
        $this->app->bind(CommandBus::class, LaravelEventDispatcher::class);

        $this->app->bind(RecipeRepository::class, EloquentRecipeRepository::class);
        $this->app->bind(IngredientRepository::class, EloquentIngredientRepository::class);
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     */
    public function boot(): void
    {
        if (!Type::hasType('uuid')) {
            Type::addType('uuid', UuidType::class);
        }
    }
}
