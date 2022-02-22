<?php

declare(strict_types = 1);

namespace App\Core\Handler\Command;

use App\Core\Command\CommandInterface;

interface HandlerInterface
{
    public function handle(CommandInterface $command): void;
}
