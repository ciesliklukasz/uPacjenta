<?php

declare(strict_types = 1);

namespace App\Application\Model\Read;

use App\Core\Model\Read\ReadModelInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Webmozart\Assert\Assert;

final class LaboratoryExaminationReadModel implements ReadModelInterface
{
    private UuidInterface $uuid;
    private int $id;
    private string $name;
    private int $categoryId;
    private string $categoryName;

    private function __construct(string $uuid, int $id, string $name, int $categoryId, string $categoryName)
    {
        $this->uuid = Uuid::fromString($uuid);
        $this->id = $id;
        $this->name = $name;
        $this->categoryId = $categoryId;
        $this->categoryName = $categoryName;
    }

    public static function fromArray(array $inputData): ReadModelInterface
    {
        Assert::keyExists($inputData, 'id');
        Assert::keyExists($inputData, 'uuid');
        Assert::keyExists($inputData, 'name');
        Assert::keyExists($inputData, 'category_id');
        Assert::keyExists($inputData, 'category_name');

        return new self(
            $inputData['uuid'],
            $inputData['id'],
            $inputData['name'],
            $inputData['category_id'],
            $inputData['category_name'],
        );
    }

    public function toJson(): string
    {
        return json_encode([
            'id' => $this->id,
            'uuid' => $this->uuid->toString(),
            'name' => $this->name,
            'category' => [
                'id' => $this->categoryId,
                'name' => $this->categoryName,
            ]
        ], JSON_THROW_ON_ERROR);
    }

    public function identifier(): UuidInterface
    {
        return $this->uuid;
    }
}
