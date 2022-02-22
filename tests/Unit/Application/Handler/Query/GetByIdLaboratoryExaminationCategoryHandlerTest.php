<?php

declare(strict_types = 1);

namespace Tests\Unit\Application\Handler\Query;

use App\Application\Handler\Query\GetByIdLaboratoryExaminationCategoryCategoryHandler;
use App\Application\Handler\Query\GetByIdLaboratoryExaminationCategoryHandler;
use App\Application\Model\Read\LaboratoryExaminationCategoryReadModel;
use App\Application\Query\GetByIdLaboratoryExaminationCategoryQuery;
use App\Core\Query\QueryInterface;
use App\Infrastructure\Repository\LaboratoryExaminationCategoryRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\InvalidArgumentException;

class GetByIdLaboratoryExaminationCategoryHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $repository = $this->createMock(LaboratoryExaminationCategoryRepository::class);
        $query = new GetByIdLaboratoryExaminationCategoryQuery(1);

        $readModel = LaboratoryExaminationCategoryReadModel::fromArray([
            'id' => 1,
            'uuid' => Uuid::uuid4()->toString(),
            'name' => 'test',
        ]);
        $repository->expects(self::once())->method('getById')->willReturn(
            $readModel
        );

        $handler = new GetByIdLaboratoryExaminationCategoryHandler($repository);
        $model = $handler->handle($query);

        self::assertEquals($model, $readModel);
    }

    public function testHandleFailedWithInvalidCommandProvided(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $query = $this->createMock(QueryInterface::class);
        $repository = $this->createMock(LaboratoryExaminationCategoryRepository::class);

        $handler = new GetByIdLaboratoryExaminationCategoryHandler($repository);
        $handler->handle($query);
    }
}
