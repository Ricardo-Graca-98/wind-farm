<?php

namespace App\Http\Controllers\GradeType;

use App\Models\GradeType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\GradeType\GradeTypeResource;
use App\Http\Resources\GradeType\GradeTypeCollection;

class GradeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new GradeTypeCollection(GradeType::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GradeType  $gradeType
     * @return \Illuminate\Http\Response
     */
    public function show(GradeType $gradeType)
    {
        return new GradeTypeResource($gradeType);
    }
}
