<?php

declare(strict_types = 1);

namespace App\Application\Handler\Command;

use App\Application\Command\CreateLaboratoryExaminationCommand;
use App\Application\Model\Write\LaboratoryExaminationWriteModel;
use App\Core\Command\CommandInterface;
use App\Core\Handler\Command\HandlerInterface;
use App\Infrastructure\Repository\LaboratoryExaminationRepository;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

class CreateLaboratoryExaminationHandler implements HandlerInterface
{
    private LaboratoryExaminationRepository $repository;

    public function __construct(LaboratoryExaminationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CommandInterface $command): void
    {
        Assert::isInstanceOf($command, CreateLaboratoryExaminationCommand::class);

        $this->repository->save(
            new LaboratoryExaminationWriteModel($command->getUuid(), $command->getCategoryId(), $command->getName())
        );
    }
}
