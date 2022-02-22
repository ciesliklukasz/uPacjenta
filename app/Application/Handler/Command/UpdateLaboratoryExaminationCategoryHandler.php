<?php

declare(strict_types = 1);

namespace App\Application\Handler\Command;

use App\Application\Command\UpdateLaboratoryExaminationCategoryCommand;
use App\Application\Model\Write\LaboratoryExaminationCategoryWriteModel;
use App\Core\Command\CommandInterface;
use App\Core\Handler\Command\HandlerInterface;
use App\Infrastructure\Repository\LaboratoryExaminationCategoryRepository;
use Webmozart\Assert\Assert;

class UpdateLaboratoryExaminationCategoryHandler implements HandlerInterface
{
    private LaboratoryExaminationCategoryRepository $repository;

    public function __construct(LaboratoryExaminationCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CommandInterface $command): void
    {
        Assert::isInstanceOf($command, UpdateLaboratoryExaminationCategoryCommand::class);

        $readModal = $this->repository->getById($command->getId());

        $this->repository->update(
            new LaboratoryExaminationCategoryWriteModel($readModal->identifier(), $command->getName())
        );
    }
}
