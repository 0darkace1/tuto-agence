<?php

namespace App\Http\Controllers\Api;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PropertiesIndexRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PropertiesIndexRequest $request)
    {
        $per_page = $request->validated("per_page") ?? 25;

        return Property::paginate($per_page);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        return Property::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
