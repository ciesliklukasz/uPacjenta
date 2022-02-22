<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Application\Command\CreateLaboratoryExaminationCommand;
use App\Application\Command\DeleteLaboratoryExaminationCommand;
use App\Application\Command\UpdateLaboratoryExaminationCommand;
use App\Application\Query\FromCategoryLaboratoryExaminationQuery;
use App\Application\Query\GetByIdLaboratoryExaminationQuery;
use App\Core\Exception\NotFoundException;
use App\SimpleCommandBus;
use App\SimpleQueryBus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class LaboratoryExaminationsController extends Controller
{
    private SimpleCommandBus $commandBus;
    private SimpleQueryBus $queryBus;

    public function __construct(SimpleCommandBus $commandBus, SimpleQueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function get(int $id): Response
    {
        try {
            $code = 200;
            $response = $this->queryBus->handle(new GetByIdLaboratoryExaminationQuery($id))->toJson();
        } catch (NotFoundException $e) {
            $code = $e->getCode();
            $response = $e->getMessage();
        }

        return response($response, $code);
    }

    public function fromCategory(int $categoryId): Response
    {
        try {
            $code = 200;
            $response = $this->queryBus->handle(new FromCategoryLaboratoryExaminationQuery($categoryId))->toJson();
        } catch (NotFoundException $e) {
            $code = $e->getCode();
            $response = $e->getMessage();
        }

        return response($response, $code);
    }

    public function create(Request $request): Response
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'category_id' => 'required|exists:laboratory_examination_category,id',
            ]);

            $command = new CreateLaboratoryExaminationCommand(
                Uuid::uuid4(),
                $request->get('name'),
                $request->get('category_id')
            );
            $this->commandBus->handle($command);

            return \response('Object created successfully.', 204);
        } catch (Exception $e) {
            return \response($e->getMessage(), 400);
        }
    }

    public function update(Request $request): Response
    {
        try {
            $request->validate([
                'id' => 'required',
                'name' => 'max:255',
                'category_id' => 'exists:laboratory_examination_category,id'
            ]);

            $command = new UpdateLaboratoryExaminationCommand(
                $request->get('id'),
                $request->get('name'),
                $request->get('category_id')
            );

            $this->commandBus->handle($command);

            return \response('Object updated successfully.', 204);

        } catch (Exception $e) {
            return \response($e->getMessage(), 400);
        }
    }

    public function delete(int $id): Response
    {
        try {
            $this->commandBus->handle(new DeleteLaboratoryExaminationCommand($id));

            return \response('Object deleted successfully.', 204);
        } catch (Exception $e) {
            return \response($e->getMessage(), 400);
        }
    }
}
