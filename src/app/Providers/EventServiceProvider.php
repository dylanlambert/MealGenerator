<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domain\Commands\InscrireUser;
use App\Domain\Commands\RegisterRecipe;
use App\Domain\Commands\UpdateRecipe;
use App\Infrastructure\Handlers\InscrireUserDatabaseHandler;
use App\Infrastructure\Handlers\RegisterRecipeDatabaseHandler;
use App\Infrastructure\Handlers\UpdateRecipeDatabaseHandler;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

final class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, class-string[]>
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        RegisterRecipe::class => [
            RegisterRecipeDatabaseHandler::class,
        ],
        UpdateRecipe::class => [
            UpdateRecipeDatabaseHandler::class,
        ],
        InscrireUser::class => [
            InscrireUserDatabaseHandler::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     */
    public function boot(): void
    {
        //
    }
}
