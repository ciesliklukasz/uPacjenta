<?php

declare(strict_types = 1);

namespace App\Application\Handler\Command;

use App\Application\Command\DeleteLaboratoryExaminationCategoryCommand;
use App\Application\Model\Write\LaboratoryExaminationCategoryWriteModel;
use App\Core\Command\CommandInterface;
use App\Core\Handler\Command\HandlerInterface;
use App\Infrastructure\Repository\LaboratoryExaminationCategoryRepository;
use Webmozart\Assert\Assert;

class DeleteLaboratoryExaminationCategoryHandler implements HandlerInterface
{
    private LaboratoryExaminationCategoryRepository $repository;

    public function __construct(LaboratoryExaminationCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CommandInterface $command): void
    {
        Assert::isInstanceOf($command, DeleteLaboratoryExaminationCategoryCommand::class);

        $readModel = $this->repository->getById($command->getId());

        $this->repository->delete(new LaboratoryExaminationCategoryWriteModel($readModel->identifier(), ''));
    }
}
