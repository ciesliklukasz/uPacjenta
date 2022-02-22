<?php

use App\Http\Controllers\LaboratoryExaminationCategoryController;
use App\Http\Controllers\LaboratoryExaminationsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Laboratory Examination CRUD
Route::get('/laboratory_examinations/{id}', [LaboratoryExaminationsController::class, 'get']);
Route::get('/laboratory_examinations/from_category/{id}', [LaboratoryExaminationsController::class, 'fromCategory']);
Route::post('/laboratory_examinations/create', [LaboratoryExaminationsController::class, 'create']);
Route::put('/laboratory_examinations/update', [LaboratoryExaminationsController::class, 'update']);
Route::delete('/laboratory_examinations/delete/{id}', [LaboratoryExaminationsController::class, 'delete']);

//Laboratory Examination Category CRUD
Route::get('/laboratory_examinations_category/{id}', [LaboratoryExaminationCategoryController::class, 'get']);
Route::post('/laboratory_examinations_category/create', [LaboratoryExaminationCategoryController::class, 'create']);
Route::put('/laboratory_examinations_category/update', [LaboratoryExaminationCategoryController::class, 'update']);
Route::delete('/laboratory_examinations_category/delete/{id}', [LaboratoryExaminationCategoryController::class, 'delete']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
