<?php

namespace App\Http\Controllers\Turbine;

use App\Models\Turbine;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\Component\ComponentResource;
use App\Http\Resources\Component\ComponentCollection;

class TurbineComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Turbine $turbine)
    {
        return new ComponentCollection($turbine->components);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Turbine $turbine, Component $component)
    {
        return new ComponentResource($component);
    }
}
