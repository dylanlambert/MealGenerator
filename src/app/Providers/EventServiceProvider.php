<?php

namespace App\Providers;

use App\Domain\Commands\RecipeRegistererCommand;
use App\Domain\Commands\UpdateRecipe;
use App\Infrastructure\Handlers\RecipeRegisterDatabaseHandler;
use App\Infrastructure\Handlers\UpdateRecipeDatabaseHandler;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        RecipeRegistererCommand::class => [
            RecipeRegisterDatabaseHandler::class,
        ],
        UpdateRecipe::class => [
            UpdateRecipeDatabaseHandler::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
