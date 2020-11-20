<?php

namespace spec\App\Application\Historic;

use App\Application\Historic\HistoricRegisterer;
use App\Application\Historic\HistoricRegistererRequest;
use App\Domain\Commands\SaveHistoric;
use App\Domain\Utils\Application\CommandBus;
use App\Domain\Utils\Id\StringId;
use PhpSpec\ObjectBehavior;

class HistoricRegistererSpec extends ObjectBehavior
{
    function let(CommandBus $commandBus)
    {
        $this->beConstructedWith($commandBus);
    }

    function it_registers(CommandBus $commandBus)
    {
        $request = new HistoricRegistererRequest(
            'historique du 09-11-2020',
            [
                new StringId('recipe-id-1'),
                new StringId('recipe-id-2'),
                new StringId('recipe-id-3'),
                new StringId('recipe-id-4'),
                new StringId('recipe-id-5'),
            ]
        );

        $command = new SaveHistoric(
            'historique du 09-11-2020',
            [
                new StringId('recipe-id-1'),
                new StringId('recipe-id-2'),
                new StringId('recipe-id-3'),
                new StringId('recipe-id-4'),
                new StringId('recipe-id-5'),
            ]
        );

        $commandBus->dispatch($command)->shouldBeCalled();

        $this->register($request)->isRegistered()->shouldBeLike(true);
    }
}
