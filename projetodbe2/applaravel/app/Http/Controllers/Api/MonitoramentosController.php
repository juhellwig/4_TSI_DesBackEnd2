<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\MonitoramentosCollection;
use App\Http\Resources\MonitoramentosResource;
use App\Models\Monitoramentos;
use Illuminate\Http\Request;

class MonitoramentosController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new MonitoramentosCollection(Monitoramentos::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Monitoramentos $monitoramentos)
    {
        return new MonitoramentosResource($monitoramentos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Monitoramentos $monitoramentos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Monitoramentos $monitoramentos)
    {
        //
    }
}
