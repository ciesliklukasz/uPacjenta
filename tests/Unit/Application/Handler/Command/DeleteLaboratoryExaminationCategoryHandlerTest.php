<?php

declare(strict_types = 1);

namespace Tests\Unit\Application\Handler\Command;

use App\Application\Command\DeleteLaboratoryExaminationCategoryCommand;
use App\Application\Handler\Command\DeleteLaboratoryExaminationCategoryHandler;
use App\Application\Model\Read\LaboratoryExaminationCategoryReadModel;
use App\Application\Model\Write\LaboratoryExaminationCategoryWriteModel;
use App\Core\Command\CommandInterface;
use App\Core\Exception\NotFoundException;
use App\Infrastructure\Repository\LaboratoryExaminationCategoryRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\InvalidArgumentException;

class DeleteLaboratoryExaminationCategoryHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $uuid = Uuid::uuid4();
        $repository = $this->createMock(LaboratoryExaminationCategoryRepository::class);
        $command = new DeleteLaboratoryExaminationCategoryCommand(1);

        $repository->expects(self::once())->method('getById')->willReturn(
            LaboratoryExaminationCategoryReadModel::fromArray([
                'id' => 1,
                'uuid' => $uuid->toString(),
                'name' => 'test'
            ])
        );

        $repository->expects(self::once())->method('delete')->with(
            new LaboratoryExaminationCategoryWriteModel($uuid, '')
        );

        $handler = new DeleteLaboratoryExaminationCategoryHandler($repository);
        $handler->handle($command);
    }

    public function testHandleFailedWhenObjectNotFoundInDB(): void
    {
        $this->expectException(NotFoundException::class);

        $repository = $this->createMock(LaboratoryExaminationCategoryRepository::class);
        $command = new DeleteLaboratoryExaminationCategoryCommand(1);

        $repository->expects(self::once())->method('getById')->willThrowException(new NotFoundException());
        $repository->expects(self::never())->method('update');

        $handler = new DeleteLaboratoryExaminationCategoryHandler($repository);
        $handler->handle($command);
    }

    public function testHandleFailedWithInvalidCommandProvided(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $command = $this->createMock(CommandInterface::class);
        $repository = $this->createMock(LaboratoryExaminationCategoryRepository::class);

        $handler = new DeleteLaboratoryExaminationCategoryHandler($repository);
        $handler->handle($command);
    }
}
