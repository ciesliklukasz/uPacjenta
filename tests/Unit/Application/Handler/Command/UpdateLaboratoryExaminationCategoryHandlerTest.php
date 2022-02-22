<?php

declare(strict_types = 1);

namespace Tests\Unit\Application\Handler\Command;

use App\Application\Command\UpdateLaboratoryExaminationCategoryCommand;
use App\Application\Handler\Command\UpdateLaboratoryExaminationCategoryHandler;
use App\Application\Model\Read\LaboratoryExaminationCategoryReadModel;
use App\Application\Model\Write\LaboratoryExaminationCategoryWriteModel;
use App\Core\Command\CommandInterface;
use App\Core\Exception\NotFoundException;
use App\Infrastructure\Repository\LaboratoryExaminationCategoryRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\InvalidArgumentException;

class UpdateLaboratoryExaminationCategoryHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $uuid = Uuid::uuid4();
        $repository = $this->createMock(LaboratoryExaminationCategoryRepository::class);
        $command = new UpdateLaboratoryExaminationCategoryCommand(1, 'test test');

        $repository->expects(self::once())->method('getById')->willReturn(
            LaboratoryExaminationCategoryReadModel::fromArray([
                'id' => 1,
                'uuid' => $uuid->toString(),
                'name' => 'test'
            ])
        );

        $repository->expects(self::once())->method('update')->with(
            new LaboratoryExaminationCategoryWriteModel($uuid, 'test test')
        );

        $handler = new UpdateLaboratoryExaminationCategoryHandler($repository);
        $handler->handle($command);
    }

    public function testHandleFailedWhenObjectNotFoundInDB(): void
    {
        $this->expectException(NotFoundException::class);

        $repository = $this->createMock(LaboratoryExaminationCategoryRepository::class);
        $command = new UpdateLaboratoryExaminationCategoryCommand(1, 'test test');

        $repository->expects(self::once())->method('getById')->willThrowException(new NotFoundException());
        $repository->expects(self::never())->method('update');

        $handler = new UpdateLaboratoryExaminationCategoryHandler($repository);
        $handler->handle($command);
    }

    public function testHandleFailedWithInvalidCommandProvided(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $command = $this->createMock(CommandInterface::class);
        $repository = $this->createMock(LaboratoryExaminationCategoryRepository::class);

        $handler = new UpdateLaboratoryExaminationCategoryHandler($repository);
        $handler->handle($command);
    }
}
