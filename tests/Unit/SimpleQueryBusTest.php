<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Core\Exception\InvalidCommandException;
use App\Core\Handler\Query\HandlerInterface;
use App\Core\Query\QueryInterface;
use App\SimpleQueryBus;
use Tests\TestCase;

class SimpleQueryBusTest extends TestCase
{
    public function testHandle(): void
    {
        $command = $this->createMock(QueryInterface::class);
        $handler = $this->createMock(HandlerInterface::class);

        $handler->expects(self::once())->method('handle')->with($command);

        $commandBus = new SimpleQueryBus([get_class($command) => $handler]);
        $commandBus->handle($command);
    }

    public function testHandleFailedWithInvalidCommandProvided(): void
    {
        $this->expectException(InvalidCommandException::class);

        $query = $this->createMock(QueryInterface::class);

        $commandBus = new SimpleQueryBus([]);
        $commandBus->handle($query);
    }
}
