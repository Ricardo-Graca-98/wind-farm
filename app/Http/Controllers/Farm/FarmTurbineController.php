<?php

namespace App\Http\Controllers\Farm;

use App\Models\Farm;
use App\Models\Turbine;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\Turbine\TurbineResource;
use App\Http\Resources\Turbine\TurbineCollection;

class FarmTurbineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Farm $farm)
    {
        return new TurbineCollection($farm->turbines);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Farm $farm, Turbine $turbine)
    {
        return new TurbineResource($turbine);
    }
}
