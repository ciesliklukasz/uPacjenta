<?php

declare(strict_types = 1);

namespace App\Infrastructure\Repository;

use App\Application\Model\Read\LaboratoryExaminationCategoryReadModel;
use App\Core\Exception\NotFoundException;
use App\Core\Infrastructure\Repository\RepositoryInterface;
use App\Core\Model\Read\ReadModelInterface;
use App\Core\Model\Write\WriteModelInterface;
use Illuminate\Support\Facades\DB;

class LaboratoryExaminationCategoryRepository implements RepositoryInterface
{
    private const TABLE_NAME = 'laboratory_examination_category';

    public function getById(int $id): ReadModelInterface
    {
        $query = DB::table(self::TABLE_NAME)
            ->select('id', 'uuid', 'name')
            ->where('id', '=', $id);
        $result = $query->get();

        if (count($result) === 0) {
            throw new NotFoundException(
                'Laboratory examination category with id: ' . $id . ' not found',
                404
            );
        }

        return LaboratoryExaminationCategoryReadModel::fromArray((array) $result[0]);
    }

    public function save(WriteModelInterface $writeModel): void
    {
        DB::table(self::TABLE_NAME)->insert($writeModel->arguments());
    }

    public function update(WriteModelInterface $writeModel): void
    {
        DB::table(self::TABLE_NAME)->where(
            'uuid', $writeModel->identifier()->toString()
        )->update($writeModel->arguments());
    }

    public function delete(WriteModelInterface $writeModel): void
    {
        DB::table(self::TABLE_NAME)->where(
            'uuid', '=', $writeModel->identifier()->toString()
        )->delete();
    }
}
