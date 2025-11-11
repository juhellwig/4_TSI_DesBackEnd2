<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\EnderecosCollection;
use App\Http\Resources\EnderecosResource;
use App\Models\Enderecos;
use Illuminate\Http\Request;

class EnderecosController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new EnderecosCollection(Enderecos::all());
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
    public function show(Enderecos $enderecos)
    {
        return new EnderecosResource($enderecos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enderecos $enderecos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enderecos $enderecos)
    {
        //
    }
}
