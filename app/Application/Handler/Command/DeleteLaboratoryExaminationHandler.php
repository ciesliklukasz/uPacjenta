<?php

declare(strict_types = 1);

namespace App\Application\Handler\Command;

use App\Application\Command\DeleteLaboratoryExaminationCommand;
use App\Application\Model\Write\LaboratoryExaminationWriteModel;
use App\Core\Command\CommandInterface;
use App\Core\Handler\Command\HandlerInterface;
use App\Infrastructure\Repository\LaboratoryExaminationRepository;
use Webmozart\Assert\Assert;

class DeleteLaboratoryExaminationHandler implements HandlerInterface
{
    private LaboratoryExaminationRepository $repository;

    public function __construct(LaboratoryExaminationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CommandInterface $command): void
    {
        Assert::isInstanceOf($command, DeleteLaboratoryExaminationCommand::class);

        $readModel = $this->repository->getById($command->getId());

        $this->repository->delete(new LaboratoryExaminationWriteModel($readModel->identifier(), 0, ''));
    }
}
