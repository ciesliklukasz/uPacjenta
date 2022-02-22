<?php

declare(strict_types = 1);

namespace App\Application\Handler\Command;

use App\Application\Command\CreateLaboratoryExaminationCategoryCommand;
use App\Application\Model\Write\LaboratoryExaminationCategoryWriteModel;
use App\Core\Command\CommandInterface;
use App\Core\Handler\Command\HandlerInterface;
use App\Infrastructure\Repository\LaboratoryExaminationCategoryRepository;
use Webmozart\Assert\Assert;

class CreateLaboratoryExaminationCategoryHandler implements HandlerInterface
{
    private LaboratoryExaminationCategoryRepository $repository;

    public function __construct(LaboratoryExaminationCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CommandInterface $command): void
    {
        Assert::isInstanceOf($command, CreateLaboratoryExaminationCategoryCommand::class);

        $this->repository->save(new LaboratoryExaminationCategoryWriteModel($command->getUuid(), $command->getName()));
    }
}
