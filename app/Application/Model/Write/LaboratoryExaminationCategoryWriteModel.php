<?php

declare(strict_types = 1);

namespace App\Application\Model\Write;

use App\Core\Model\Write\WriteModelInterface;
use Ramsey\Uuid\UuidInterface;

class LaboratoryExaminationCategoryWriteModel implements WriteModelInterface
{
    private UuidInterface $uuid;
    private string $name;

    public function __construct(UuidInterface $uuid, string $name)
    {
        $this->uuid = $uuid;
        $this->name = $name;
    }

    public function identifier(): UuidInterface
    {
        return $this->uuid;
    }

    public function arguments(): array
    {
        return [
            'uuid' => $this->uuid->toString(),
            'name' => $this->name,
        ];
    }
}
