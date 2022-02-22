<?php

declare(strict_types = 1);

namespace App\Application\Handler\Command;

use App\Application\Command\UpdateLaboratoryExaminationCommand;
use App\Application\Model\Write\LaboratoryExaminationWriteModel;
use App\Core\Command\CommandInterface;
use App\Core\Handler\Command\HandlerInterface;
use App\Infrastructure\Repository\LaboratoryExaminationRepository;
use Webmozart\Assert\Assert;

class UpdateLaboratoryExaminationHandler implements HandlerInterface
{
    private LaboratoryExaminationRepository $repository;

    public function __construct(LaboratoryExaminationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CommandInterface $command): void
    {
        Assert::isInstanceOf($command, UpdateLaboratoryExaminationCommand::class);

        $readModel = $this->repository->getById($command->getId());
        $decoded = json_decode($readModel->toJson(), true, 512, JSON_THROW_ON_ERROR);

        $this->repository->update(new LaboratoryExaminationWriteModel(
            $readModel->identifier(),
            $command->getCategoryId() ?? (int) $decoded['category']['id'],
            $command->getName() ?? $decoded['name'],
        ));
    }
}
