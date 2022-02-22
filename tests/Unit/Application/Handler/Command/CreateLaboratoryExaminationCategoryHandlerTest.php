<?php

declare(strict_types = 1);

namespace Tests\Unit\Application\Handler\Command;

use App\Application\Command\CreateLaboratoryExaminationCategoryCommand;
use App\Application\Handler\Command\CreateLaboratoryExaminationCategoryHandler;
use App\Application\Model\Write\LaboratoryExaminationCategoryWriteModel;
use App\Core\Command\CommandInterface;
use App\Infrastructure\Repository\LaboratoryExaminationCategoryRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\InvalidArgumentException;

class CreateLaboratoryExaminationCategoryHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $uuid = Uuid::uuid4();
        $repository = $this->createMock(LaboratoryExaminationCategoryRepository::class);
        $command = new CreateLaboratoryExaminationCategoryCommand($uuid, 'test');

        $repository->expects(self::once())->method('save')->with(
            new LaboratoryExaminationCategoryWriteModel($uuid, 'test')
        );

        $handler = new CreateLaboratoryExaminationCategoryHandler($repository);
        $handler->handle($command);
    }

    public function testHandleFailedWithInvalidCommandProvided(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $command = $this->createMock(CommandInterface::class);
        $repository = $this->createMock(LaboratoryExaminationCategoryRepository::class);

        $handler = new CreateLaboratoryExaminationCategoryHandler($repository);
        $handler->handle($command);
    }
}
