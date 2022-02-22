<?php

declare(strict_types = 1);

namespace App\Application\Model\Write;

use App\Core\Model\Write\WriteModelInterface;
use Ramsey\Uuid\UuidInterface;

class LaboratoryExaminationWriteModel implements WriteModelInterface
{
    private UuidInterface $uuid;
    private int $categoryId;
    private string $name;

    public function __construct(UuidInterface $uuid, int $categoryId, string $name)
    {
        $this->uuid = $uuid;
        $this->categoryId = $categoryId;
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
            'category_id' => $this->categoryId,
            'name' => $this->name,
        ];
    }
}
