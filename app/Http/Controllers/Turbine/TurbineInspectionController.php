<?php

namespace App\Http\Controllers\Turbine;

use App\Models\Turbine;
use App\Models\Inspection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\Inspection\InspectionResource;
use App\Http\Resources\Inspection\InspectionCollection;

class TurbineInspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Turbine $turbine)
    {
        return new InspectionCollection($turbine->inspections);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Turbine $turbine, Inspection $inspection)
    {
        return new InspectionResource($inspection);
    }
}
