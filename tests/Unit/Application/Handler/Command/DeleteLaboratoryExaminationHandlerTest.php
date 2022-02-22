<?php

declare(strict_types = 1);

namespace Tests\Unit\Application\Handler\Command;

use App\Application\Command\DeleteLaboratoryExaminationCommand;
use App\Application\Handler\Command\DeleteLaboratoryExaminationHandler;
use App\Application\Model\Read\LaboratoryExaminationReadModel;
use App\Application\Model\Write\LaboratoryExaminationWriteModel;
use App\Core\Command\CommandInterface;
use App\Core\Exception\NotFoundException;
use App\Infrastructure\Repository\LaboratoryExaminationRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\InvalidArgumentException;

class DeleteLaboratoryExaminationHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $uuid = Uuid::uuid4();
        $repository = $this->createMock(LaboratoryExaminationRepository::class);
        $command = new DeleteLaboratoryExaminationCommand(1);

        $repository->expects(self::once())->method('getById')->willReturn(
            LaboratoryExaminationReadModel::fromArray([
                'id' => 1,
                'uuid' => $uuid->toString(),
                'name' => 'test',
                'category_id' => 1,
                'category_name' => 'test test'
            ])
        );

        $repository->expects(self::once())->method('delete')->with(
            new LaboratoryExaminationWriteModel($uuid, 0, '')
        );

        $handler = new DeleteLaboratoryExaminationHandler($repository);
        $handler->handle($command);
    }

    public function testHandleFailedWhenObjectNotFoundInDB(): void
    {
        $this->expectException(NotFoundException::class);

        $repository = $this->createMock(LaboratoryExaminationRepository::class);
        $command = new DeleteLaboratoryExaminationCommand(1);

        $repository->expects(self::once())->method('getById')->willThrowException(new NotFoundException());
        $repository->expects(self::never())->method('update');

        $handler = new DeleteLaboratoryExaminationHandler($repository);
        $handler->handle($command);
    }

    public function testHandleFailedWithInvalidCommandProvided(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $command = $this->createMock(CommandInterface::class);
        $repository = $this->createMock(LaboratoryExaminationRepository::class);

        $handler = new DeleteLaboratoryExaminationHandler($repository);
        $handler->handle($command);
    }
}
