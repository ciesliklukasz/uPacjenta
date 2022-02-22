<?php

declare(strict_types = 1);

namespace App\Core\Infrastructure\Repository;

use App\Core\Model\Read\ReadModelInterface;
use App\Core\Model\Write\WriteModelInterface;

interface RepositoryInterface
{
    public function getById(int $id): ReadModelInterface;
    public function save(WriteModelInterface $writeModel): void;
    public function update(WriteModelInterface $writeModel): void;
    public function delete(WriteModelInterface $writeModel): void;
}
