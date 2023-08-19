<?php

namespace App\Http\Controllers\Component;

use App\Models\Grade;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\Grade\GradeResource;
use App\Http\Resources\Grade\GradeCollection;

class ComponentGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Component $component)
    {
        return new GradeCollection($component->grades);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function show(Component $component, Grade $grade)
    {
        return new GradeResource($grade);
    }
}
