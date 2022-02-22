<?php

declare(strict_types = 1);

namespace Tests\Unit\Application\Handler\Query;

use App\Application\Handler\Query\GetByIdLaboratoryExaminationHandler;
use App\Application\Model\Read\LaboratoryExaminationReadModel;
use App\Application\Query\GetByIdLaboratoryExaminationQuery;
use App\Core\Query\QueryInterface;
use App\Infrastructure\Repository\LaboratoryExaminationRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\InvalidArgumentException;

class GetByIdLaboratoryExaminationHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $repository = $this->createMock(LaboratoryExaminationRepository::class);
        $query = new GetByIdLaboratoryExaminationQuery(1);

        $readModel = LaboratoryExaminationReadModel::fromArray([
            'id' => 1,
            'uuid' => Uuid::uuid4()->toString(),
            'name' => 'test',
            'category_id' => 1,
            'category_name' => 'test test',
        ]);
        $repository->expects(self::once())->method('getById')->willReturn(
            $readModel
        );

        $handler = new GetByIdLaboratoryExaminationHandler($repository);
        $model = $handler->handle($query);

        self::assertEquals($model, $readModel);
    }

    public function testHandleFailedWithInvalidCommandProvided(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $query = $this->createMock(QueryInterface::class);
        $repository = $this->createMock(LaboratoryExaminationRepository::class);

        $handler = new GetByIdLaboratoryExaminationHandler($repository);
        $handler->handle($query);
    }
}
