<?php

declare(strict_types = 1);

namespace App\Application\Command;

use App\Core\Command\CommandInterface;
use Ramsey\Uuid\UuidInterface;

class CreateLaboratoryExaminationCommand implements CommandInterface
{
    private UuidInterface $uuid;
    private string $name;
    private int $categoryId;

    public function __construct(UuidInterface $uuid, string $name, int $categoryId)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->categoryId = $categoryId;
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }
}
