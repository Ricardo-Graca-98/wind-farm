<?php

namespace App\Http\Controllers\Grade;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\Grade\GradeResource;
use App\Http\Resources\Grade\GradeCollection;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new GradeCollection(Grade::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        return new GradeResource($grade);
    }
}
