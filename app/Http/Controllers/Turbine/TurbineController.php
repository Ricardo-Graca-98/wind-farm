<?php

namespace App\Http\Controllers\Turbine;

use App\Models\Turbine;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\Turbine\TurbineResource;
use App\Http\Resources\Turbine\TurbineCollection;

class TurbineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TurbineCollection(Turbine::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Turbine $turbine)
    {
        return new TurbineResource($turbine);
    }
}
