<?php

declare(strict_types = 1);

namespace App\Application\Command;

use App\Core\Command\CommandInterface;
use Ramsey\Uuid\UuidInterface;

class CreateLaboratoryExaminationCategoryCommand implements CommandInterface
{
    private UuidInterface $uuid;
    private string $name;

    public function __construct(UuidInterface $uuid, string $name)
    {
        $this->uuid = $uuid;
        $this->name = $name;
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
