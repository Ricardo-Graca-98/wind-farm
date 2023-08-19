<?php

namespace App\Http\Controllers\Inspection;

use App\Models\Inspection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\Inspection\InspectionResource;
use App\Http\Resources\Inspection\InspectionCollection;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new InspectionCollection(Inspection::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function show(Inspection $inspection)
    {
        return new InspectionResource($inspection);
        
    }
}
