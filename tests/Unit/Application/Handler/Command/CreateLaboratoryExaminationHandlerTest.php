<?php

declare(strict_types = 1);

namespace Tests\Unit\Application\Handler\Command;

use App\Application\Command\CreateLaboratoryExaminationCommand;
use App\Application\Handler\Command\CreateLaboratoryExaminationHandler;
use App\Application\Model\Write\LaboratoryExaminationWriteModel;
use App\Core\Command\CommandInterface;
use App\Infrastructure\Repository\LaboratoryExaminationRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\InvalidArgumentException;

class CreateLaboratoryExaminationHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $uuid = Uuid::uuid4();
        $repository = $this->createMock(LaboratoryExaminationRepository::class);
        $command = new CreateLaboratoryExaminationCommand($uuid, 'test', 1);

        $repository->expects(self::once())->method('save')->with(
            new LaboratoryExaminationWriteModel($uuid, 1,'test')
        );

        $handler = new CreateLaboratoryExaminationHandler($repository);
        $handler->handle($command);
    }

    public function testHandleFailedWithInvalidCommandProvided(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $command = $this->createMock(CommandInterface::class);
        $repository = $this->createMock(LaboratoryExaminationRepository::class);

        $handler = new CreateLaboratoryExaminationHandler($repository);
        $handler->handle($command);
    }
}
