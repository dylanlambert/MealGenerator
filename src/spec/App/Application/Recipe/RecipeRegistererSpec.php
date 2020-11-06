<?php

namespace spec\App\Application\Recipe;

use App\Application\Recipe\RecipeRegisterer;
use App\Application\Recipe\RecipeRegistererRequest;
use App\Domain\Commands\RecipeRegistererCommand;
use App\Domain\Utils\Command\CommandBus;
use PhpSpec\ObjectBehavior;

class RecipeRegistererSpec extends ObjectBehavior
{
    function let(CommandBus $commandBus)
    {
        $this->beConstructedWith($commandBus);
    }

    function it_registers_recipe(CommandBus $commandBus)
    {
        $request = new RecipeRegistererRequest(
            'Recipe Name',
            600,
        );

        $command = new RecipeRegistererCommand(
            'Recipe Name',
            600
        );

        $commandBus->dispatch($command)->shouldBeCalled();

        $this->register($request)->isRegistered()->shouldBe(true);
    }

    function it_catches_error(CommandBus $commandBus)
    {
        $request = new RecipeRegistererRequest(
            'Recipe Name',
            600,
        );

        $command = new RecipeRegistererCommand(
            'Recipe Name',
            600
        );

        $commandBus->dispatch($command)->shouldBeCalled()->willThrow(\Exception::class);

        $this->register($request)->isRegistered()->shouldBe(false);
    }
}
