<?php

declare(strict_types = 1);

namespace App\Application\Command;

use App\Core\Command\CommandInterface;

class UpdateLaboratoryExaminationCommand implements CommandInterface
{
    private int $id;
    private ?string $name;
    private ?int $categoryId;

    public function __construct(int $id, ?string $name = null, ?int $categoryId = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->categoryId = $categoryId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }
}
