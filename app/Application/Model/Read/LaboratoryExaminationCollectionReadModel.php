<?php

declare(strict_types = 1);

namespace App\Application\Model\Read;

use App\Core\Model\Read\ReadModelInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class LaboratoryExaminationCollectionReadModel implements ReadModelInterface
{
    private array $collection;

    private function __construct(array $collection)
    {
        $this->collection = $collection;
    }

    public static function fromArray(array $inputData): ReadModelInterface
    {
        return new self($inputData);
    }

    public function toJson(): string
    {
        $data = [];
        foreach ($this->collection as $item) {
            $data[] = json_decode(LaboratoryExaminationReadModel::fromArray((array) $item)->toJson(), true);
        }
        return json_encode($data, JSON_THROW_ON_ERROR);
    }

    public function identifier(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
