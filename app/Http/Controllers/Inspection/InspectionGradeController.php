<?php

namespace App\Http\Controllers\Inspection;

use App\Models\Grade;
use App\Models\Inspection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\Grade\GradeResource;
use App\Http\Resources\Grade\GradeCollection;

class InspectionGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Inspection $inspection)
    {
        return new GradeCollection($inspection->grades);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function show(Inspection $inspection, Grade $grade)
    {
        return new GradeResource($grade);
    }
}
