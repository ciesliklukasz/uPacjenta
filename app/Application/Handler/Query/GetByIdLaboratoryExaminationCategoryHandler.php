<?php

declare(strict_types = 1);

namespace App\Application\Handler\Query;

use App\Application\Query\GetByIdLaboratoryExaminationCategoryQuery;
use App\Core\Handler\Query\HandlerInterface;
use App\Core\Model\Read\ReadModelInterface;
use App\Core\Query\QueryInterface;
use App\Infrastructure\Repository\LaboratoryExaminationCategoryRepository;
use Webmozart\Assert\Assert;

class GetByIdLaboratoryExaminationCategoryHandler implements HandlerInterface
{
    private LaboratoryExaminationCategoryRepository $repository;

    public function __construct(LaboratoryExaminationCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(QueryInterface $query): ReadModelInterface
    {
        Assert::isInstanceOf($query, GetByIdLaboratoryExaminationCategoryQuery::class);

        return $this->repository->getById($query->getId());
    }
}
