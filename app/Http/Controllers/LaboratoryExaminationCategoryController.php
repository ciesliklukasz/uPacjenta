<?php

namespace App\Http\Controllers;

use App\Application\Command\CreateLaboratoryExaminationCategoryCommand;
use App\Application\Command\DeleteLaboratoryExaminationCategoryCommand;
use App\Application\Command\UpdateLaboratoryExaminationCategoryCommand;
use App\Application\Query\GetByIdLaboratoryExaminationCategoryQuery;
use App\Core\Exception\NotFoundException;
use App\SimpleCommandBus;
use App\SimpleQueryBus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class LaboratoryExaminationCategoryController extends Controller
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
            $response = $this->queryBus->handle(new GetByIdLaboratoryExaminationCategoryQuery($id))->toJson();
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
            ]);
        } catch (Exception $e) {
            return \response($e->getMessage(), 400);
        }

        $command = new CreateLaboratoryExaminationCategoryCommand(
            Uuid::uuid4(),
            $request->get('name')
        );

        $this->commandBus->handle($command);

        return \response('Object created successfully.', 204);
    }

    public function update(Request $request): Response
    {
        try {
            $request->validate([
                'id' => 'required',
                'name' => 'required|max:255',
            ]);

            $command = new UpdateLaboratoryExaminationCategoryCommand(
                $request->get('id'),
                $request->get('name')
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
            $this->commandBus->handle(new DeleteLaboratoryExaminationCategoryCommand($id));

            return \response('Object deleted successfully.', 204);
        } catch (Exception $e) {
            return \response($e->getMessage(), 400);
        }
    }
}
