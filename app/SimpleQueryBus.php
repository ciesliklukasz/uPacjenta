<?php

declare(strict_types = 1);

namespace App;

use App\Core\Exception\InvalidCommandException;
use App\Core\Handler\Query\HandlerInterface;
use App\Core\Model\Read\ReadModelInterface;
use App\Core\Query\QueryInterface;

final class SimpleQueryBus
{
    /** @var HandlerInterface[] */
    private array $handlers;

    public function __construct(array $handlers)
    {
        $this->handlers = $handlers;
    }

    public function handle(QueryInterface $query): ReadModelInterface
    {
        $queryClass = get_class($query);

        if (isset($this->handlers[$queryClass])) {
            return $this->handlers[$queryClass]->handle($query);
        }

        throw new InvalidCommandException('Cannot call proper request', 500);
    }

}
