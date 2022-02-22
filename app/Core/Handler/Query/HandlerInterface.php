<?php

declare(strict_types = 1);

namespace App\Core\Handler\Query;

use App\Core\Model\Read\ReadModelInterface;
use App\Core\Query\QueryInterface;

interface HandlerInterface
{
    public function handle(QueryInterface $query): ReadModelInterface;
}
