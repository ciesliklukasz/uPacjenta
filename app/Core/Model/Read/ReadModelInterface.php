<?php

declare(strict_types = 1);

namespace App\Core\Model\Read;

use Ramsey\Uuid\UuidInterface;

interface ReadModelInterface
{
    public static function fromArray(array $inputData): self;
    public function toJson(): string;
    public function identifier(): UuidInterface;
}
