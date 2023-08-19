<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Farm\FarmController;
use App\Http\Controllers\Farm\FarmTurbineController;

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

Route::resource('farms', FarmController::class)->only(['index', 'show']);
Route::resource('farms.turbines', FarmTurbineController::class)->only(['index', 'show']);

Route::resource('turbines', TurbineController::class)->only(['index', 'show']);
Route::resource('turbines.components', TurbineComponentController::class)->only(['index', 'show']);
Route::resource('turbines.inspections', TurbineInspectionController::class)->only(['index', 'show']);
