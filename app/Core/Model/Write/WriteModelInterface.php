<?php

declare(strict_types = 1);

namespace App\Core\Model\Write;

use Ramsey\Uuid\UuidInterface;

interface WriteModelInterface
{
    public function identifier(): UuidInterface;
    public function arguments(): array;
}
