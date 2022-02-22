<?php

declare(strict_types = 1);

namespace Tests\Unit\Application\Handler\Query;

use App\Application\Handler\Query\FromCategoryLaboratoryExaminationHandler;
use App\Application\Model\Read\LaboratoryExaminationCollectionReadModel;
use App\Application\Query\FromCategoryLaboratoryExaminationQuery;
use App\Core\Query\QueryInterface;
use App\Infrastructure\Repository\LaboratoryExaminationRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\InvalidArgumentException;

class FromCategoryLaboratoryExaminationHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $repository = $this->createMock(LaboratoryExaminationRepository::class);
        $query = new FromCategoryLaboratoryExaminationQuery(1);

        $readModel = LaboratoryExaminationCollectionReadModel::fromArray([
            [
                'id' => 1,
                'uuid' => Uuid::uuid4()->toString(),
                'name' => 'test 1',
                'category_id' => 1,
                'category_name' => 'test test',
            ],
            [
                'id' => 2,
                'uuid' => Uuid::uuid4()->toString(),
                'name' => 'test 2',
                'category_id' => 1,
                'category_name' => 'test test',
            ],
            [
                'id' => 3,
                'uuid' => Uuid::uuid4()->toString(),
                'name' => 'test 3',
                'category_id' => 1,
                'category_name' => 'test test',
            ],
            [
                'id' => 4,
                'uuid' => Uuid::uuid4()->toString(),
                'name' => 'test 4',
                'category_id' => 1,
                'category_name' => 'test test',
            ],
        ]);
        $repository->expects(self::once())->method('fromCategory')->willReturn($readModel);

        $handler = new FromCategoryLaboratoryExaminationHandler($repository);
        $model = $handler->handle($query);

        self::assertEquals($model, $readModel);
    }

    public function testHandleFailedWithInvalidCommandProvided(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $query = $this->createMock(QueryInterface::class);
        $repository = $this->createMock(LaboratoryExaminationRepository::class);

        $handler = new FromCategoryLaboratoryExaminationHandler($repository);
        $handler->handle($query);
    }
}
