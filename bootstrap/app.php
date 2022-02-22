<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

use App\Application\Command\CreateLaboratoryExaminationCategoryCommand;
use App\Application\Command\CreateLaboratoryExaminationCommand;
use App\Application\Command\DeleteLaboratoryExaminationCategoryCommand;
use App\Application\Command\DeleteLaboratoryExaminationCommand;
use App\Application\Command\GetLaboratoryExamination;
use App\Application\Command\UpdateLaboratoryExaminationCategoryCommand;
use App\Application\Command\UpdateLaboratoryExaminationCommand;
use App\Application\Handler\Command\CreateLaboratoryExaminationCategoryHandler;
use App\Application\Handler\Command\CreateLaboratoryExaminationHandler;
use App\Application\Handler\Command\DeleteLaboratoryExaminationCategoryHandler;
use App\Application\Handler\Command\DeleteLaboratoryExaminationHandler;
use App\Application\Handler\Command\UpdateLaboratoryExaminationCategoryHandler;
use App\Application\Handler\Command\UpdateLaboratoryExaminationHandler;
use App\Application\Handler\Query\FromCategoryLaboratoryExaminationHandler;
use App\Application\Handler\Query\GetByIdLaboratoryExaminationCategoryHandler;
use App\Application\Handler\Query\GetByIdLaboratoryExaminationHandler;
use App\Application\Query\FromCategoryLaboratoryExaminationQuery;
use App\Application\Query\GetByIdLaboratoryExaminationCategoryQuery;
use App\Application\Query\GetByIdLaboratoryExaminationQuery;
use App\SimpleCommandBus;
use App\SimpleQueryBus;

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->when(SimpleCommandBus::class)
    ->needs('$handlers')
    ->give(function($app) {
        return [
            //Laboratory Examination
            CreateLaboratoryExaminationCommand::class => $app->make(CreateLaboratoryExaminationHandler::class),
            UpdateLaboratoryExaminationCommand::class => $app->make(UpdateLaboratoryExaminationHandler::class),
            DeleteLaboratoryExaminationCommand::class => $app->make(DeleteLaboratoryExaminationHandler::class),
            //Laboratory Examination Category
            CreateLaboratoryExaminationCategoryCommand::class => $app->make(CreateLaboratoryExaminationCategoryHandler::class),
            UpdateLaboratoryExaminationCategoryCommand::class => $app->make(UpdateLaboratoryExaminationCategoryHandler::class),
            DeleteLaboratoryExaminationCategoryCommand::class => $app->make(DeleteLaboratoryExaminationCategoryHandler::class),
        ];
    });

$app->when(SimpleQueryBus::class)
    ->needs('$handlers')
    ->give(function($app) {
        return [
            //Laboratory Examination
            GetByIdLaboratoryExaminationQuery::class => $app->make(GetByIdLaboratoryExaminationHandler::class),
            FromCategoryLaboratoryExaminationQuery::class => $app->make(FromCategoryLaboratoryExaminationHandler::class),
            //Laboratory Examination Category
            GetByIdLaboratoryExaminationCategoryQuery::class => $app->make(GetByIdLaboratoryExaminationCategoryHandler::class),
        ];
    });
$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
