<?php

namespace App\Http\Controllers\ComponentType;

use Illuminate\Http\Request;
use App\Models\ComponentType;
use Illuminate\Routing\Controller;
use App\Http\Resources\ComponentType\ComponentTypeResource;
use App\Http\Resources\ComponentType\ComponentTypeCollection;

class ComponentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ComponentTypeCollection(ComponentType::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComponentType  $componentType
     * @return \Illuminate\Http\Response
     */
    public function show(ComponentType $componentType)
    {
        return new ComponentTypeResource($componentType);
    }
}
