<?php

namespace App\Http\Controllers\Farm;

use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\Farm\FarmResource;
use App\Http\Resources\Farm\FarmCollection;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new FarmCollection(Farm::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function show(Farm $farm)
    {
        return new FarmResource($farm);
    }
}
