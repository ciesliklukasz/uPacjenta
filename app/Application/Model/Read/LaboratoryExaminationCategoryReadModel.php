<?php

declare(strict_types = 1);

namespace App\Application\Model\Read;

use App\Core\Model\Read\ReadModelInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Webmozart\Assert\Assert;

final class LaboratoryExaminationCategoryReadModel implements ReadModelInterface
{
    private int $id;
    private UuidInterface $uuid;
    private string $name;

    private function __construct(int $id, UuidInterface $uuid, string $name)
    {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->name = $name;
    }

    public static function fromArray(array $inputData): ReadModelInterface
    {
        Assert::keyExists($inputData, 'id');
        Assert::keyExists($inputData, 'uuid');
        Assert::keyExists($inputData, 'name');

        return new self(
            (int) $inputData['id'],
            Uuid::fromString($inputData['uuid']),
            $inputData['name']
        );
    }

    public function toJson(): string
    {
        return json_encode([
            'id' => $this->id,
            'uuid' => $this->uuid->toString(),
            'name' => $this->name,
        ], JSON_THROW_ON_ERROR);
    }

    public function identifier(): UuidInterface
    {
        return $this->uuid;
    }
}
