<?php

declare(strict_types = 1);

namespace App\Application\Query;

use App\Core\Query\QueryInterface;

class GetByIdLaboratoryExaminationQuery implements QueryInterface
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
