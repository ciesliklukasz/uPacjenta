<?php

declare(strict_types = 1);

namespace App\Application\Query;

use App\Core\Query\QueryInterface;

class FromCategoryLaboratoryExaminationQuery implements QueryInterface
{
    private int $categoryId;

    public function __construct(int $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }
}
