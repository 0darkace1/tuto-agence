<?php

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyFormRequest;
use App\Models\Option;
use App\Models\Picture;

class AdminPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.properties.index", [
            'properties' => Property::recent()->withTrashed()->paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $property = new Property();
        $property->fill([
            "surface" => 40,
            "rooms" => 3,
            "floor" => 1,
            "bedrooms" => 2,
            "city" => "Paris",
            "postal_code" => "75000",
            "sold" => false,
        ]);

        return view("admin.properties.form", [
            'property' => $property,
            'options' => Option::pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyFormRequest $request)
    {
        $property = Property::create($request->validated());
        $property->options()->sync($request->validated("options"));
        if ($request->validated("pictures")) {
            $property->attachFiles($request->validated('pictures'));
        }

        return to_route("admin.properties.index")->with("success", "Le bien a bien été créé");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view("admin.properties.form", [
            "property" => $property,
            'options' => Option::pluck('name', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyFormRequest $request, Property $property)
    {
        $property->options()->sync($request->validated("options"));
        $property->update($request->validated());
        if ($request->validated("pictures")) {
            $property->attachFiles($request->validated('pictures'));
        }

        return to_route("admin.properties.index")->with("success", "Le bien a bien été modifié");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        Picture::destroy(
            $property->pictures()->pluck('id')
        );

        $property->delete();
        // $property->forceDelete(); // Forcer la suppression (désactiver soft delete)

        return to_route("admin.properties.index")->with("success", "Le bien a bien été supprimé");
    }

    /**
     * Restore the specified resource from soft delete.
     */
    public function restore(int $propertyId)
    {
        Property::onlyTrashed()->find($propertyId)->restore();

        return to_route("admin.properties.index")->with("success", "Le bien a bien été restauré");
    }
}
