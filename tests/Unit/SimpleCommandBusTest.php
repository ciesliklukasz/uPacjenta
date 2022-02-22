<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Core\Command\CommandInterface;
use App\Core\Exception\InvalidCommandException;
use App\Core\Handler\Command\HandlerInterface;
use App\SimpleCommandBus;
use Tests\TestCase;

class SimpleCommandBusTest extends TestCase
{
    public function testHandle(): void
    {
        $command = $this->createMock(CommandInterface::class);
        $handler = $this->createMock(HandlerInterface::class);

        $handler->expects(self::once())->method('handle')->with($command);

        $commandBus = new SimpleCommandBus([get_class($command) => $handler]);
        $commandBus->handle($command);
    }

    public function testHandleFailedWithInvalidCommandProvided(): void
    {
        $this->expectException(InvalidCommandException::class);

        $command = $this->createMock(CommandInterface::class);

        $commandBus = new SimpleCommandBus([]);
        $commandBus->handle($command);
    }
}
