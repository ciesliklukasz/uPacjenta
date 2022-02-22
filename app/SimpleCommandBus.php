<?php

declare(strict_types = 1);

namespace App;

use App\Core\Command\CommandInterface;
use App\Core\Exception\InvalidCommandException;
use App\Core\Handler\Command\HandlerInterface;

class SimpleCommandBus
{
    /** @var HandlerInterface[] */
    private array $handlers;

    public function __construct(array $handlers)
    {
        $this->handlers = $handlers;
    }

    public function handle(CommandInterface $command): void
    {
        $commandClass = get_class($command);

        if (isset($this->handlers[$commandClass])) {
            $this->handlers[$commandClass]->handle($command);
            return;
        }

        throw new InvalidCommandException('Cannot call proper request', 500);
    }
}
