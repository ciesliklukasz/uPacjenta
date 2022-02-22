<?php

declare(strict_types = 1);

namespace App\Infrastructure\Repository;

use App\Application\Model\Read\LaboratoryExaminationCollectionReadModel;
use App\Application\Model\Read\LaboratoryExaminationReadModel;
use App\Core\Exception\NotFoundException;
use App\Core\Infrastructure\Repository\RepositoryInterface;
use App\Core\Model\Read\ReadModelInterface;
use App\Core\Model\Write\WriteModelInterface;
use Illuminate\Support\Facades\DB;

class LaboratoryExaminationRepository implements RepositoryInterface
{
    private const TABLE_NAME = 'laboratory_examinations';

    public function getById(int $id): ReadModelInterface
    {
        $query = DB::table(self::TABLE_NAME)
            ->select(
                'laboratory_examinations.id',
                'laboratory_examinations.uuid',
                'laboratory_examinations.name',
                'laboratory_examinations.category_id',
                'laboratory_examination_category.name as category_name'
            )
            ->where('laboratory_examinations.id', '=', $id)
            ->join(
                'laboratory_examination_category',
                'laboratory_examination_category.id',
                '=',
                'laboratory_examinations.category_id'
            );
        $result = $query->get();

        if (count($result) === 0) {
            throw new NotFoundException(
                'Laboratory examination with id: ' . $id . ' not found',
                404
            );
        }

        return LaboratoryExaminationReadModel::fromArray((array) $result[0]);
    }

    public function fromCategory(int $categoryId): ReadModelInterface
    {
        $query = DB::table(self::TABLE_NAME)
            ->select(
                'laboratory_examinations.id',
                'laboratory_examinations.uuid',
                'laboratory_examinations.name',
                'laboratory_examinations.category_id',
                'laboratory_examination_category.name as category_name'
            )
            ->where('laboratory_examinations.category_id', '=', $categoryId)
            ->join(
                'laboratory_examination_category',
                'laboratory_examination_category.id',
                '=',
                'laboratory_examinations.category_id'
            );
        $result = $query->get();

        if (count($result) === 0) {
            throw new NotFoundException(
                'Laboratory examinations for category: ' . $categoryId . ' not found',
                404
            );
        }

        return LaboratoryExaminationCollectionReadModel::fromArray($result->all());
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
