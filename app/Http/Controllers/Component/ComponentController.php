<?php

namespace App\Http\Controllers\Component;

use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\Component\ComponentResource;
use App\Http\Resources\Component\ComponentCollection;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ComponentCollection(Component::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function show(Component $component)
    {
        return new ComponentResource($component);
    }
}
