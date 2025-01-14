<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Farm\FarmController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\Turbine\TurbineController;
use App\Http\Controllers\Farm\FarmTurbineController;
use App\Http\Controllers\Component\ComponentController;
use App\Http\Controllers\GradeType\GradeTypeController;
use App\Http\Controllers\Inspection\InspectionController;
use App\Http\Controllers\Component\ComponentGradeController;
use App\Http\Controllers\Turbine\TurbineComponentController;
use App\Http\Controllers\Turbine\TurbineInspectionController;
use App\Http\Controllers\Inspection\InspectionGradeController;
use App\Http\Controllers\ComponentType\ComponentTypeController;

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

// Wrap up all these routes under sanctum middleware protection for authenticated requests from the frontend.
// Route::middleware('auth:sanctum')->group(function () {
Route::resource('farms', FarmController::class)->only(['index', 'show']);
Route::resource('farms.turbines', FarmTurbineController::class)->only(['index', 'show']);

Route::resource('turbines', TurbineController::class)->only(['index', 'show']);
Route::resource('turbines.components', TurbineComponentController::class)->only(['index', 'show']);
Route::resource('turbines.inspections', TurbineInspectionController::class)->only(['index', 'show']);

Route::resource('components', ComponentController::class)->only(['index', 'show']);
Route::resource('components.grades', ComponentGradeController::class)->only(['index', 'show']);

Route::resource('inspections', InspectionController::class)->only(['index', 'show']);
Route::resource('inspections.grades', InspectionGradeController::class)->only(['index', 'show']);

Route::resource('grades', GradeController::class)->only(['index', 'show']);

Route::resource('component-types', ComponentTypeController::class)->only(['index', 'show']);

Route::resource('grade-types', GradeTypeController::class)->only(['index', 'show']);
// });
