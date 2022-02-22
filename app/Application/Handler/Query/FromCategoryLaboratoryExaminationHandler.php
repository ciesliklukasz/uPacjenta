<?php

declare(strict_types = 1);

namespace App\Application\Handler\Query;

use App\Application\Query\FromCategoryLaboratoryExaminationQuery;
use App\Core\Handler\Query\HandlerInterface;
use App\Core\Model\Read\ReadModelInterface;
use App\Core\Query\QueryInterface;
use App\Infrastructure\Repository\LaboratoryExaminationRepository;
use Webmozart\Assert\Assert;

class FromCategoryLaboratoryExaminationHandler implements HandlerInterface
{
    private LaboratoryExaminationRepository $repository;

    public function __construct(LaboratoryExaminationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(QueryInterface $query): ReadModelInterface
    {
        Assert::isInstanceOf($query, FromCategoryLaboratoryExaminationQuery::class);

        return $this->repository->fromCategory($query->getCategoryId());
    }
}
