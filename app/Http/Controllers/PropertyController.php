<?php

namespace App\Http\Controllers;

use App\Events\ContactRequestEvent;
use App\Models\Property;
use Illuminate\Support\Str;
use App\Mail\PropertyContactMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PropertyContactRequest;
use App\Http\Requests\SearchPropertiesRequest;
use App\Models\User;
use App\Notifications\ContactRequestNotification;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchPropertiesRequest $request)
    {
        $query = Property::query();
        if ($request->validated('surface')) {
            $query = $query->where("surface", ">=", $request->validated('surface'));
        }
        if ($request->validated('rooms')) {
            $query = $query->where("rooms", ">=", $request->validated('rooms'));
        }
        if ($request->validated('price')) {
            $query = $query->where("price", "<=", $request->validated('price'));
        }
        if ($request->validated('keyword')) {
            $query = $query->where("title", "like", "%{$request->validated("keyword")}%");
        }

        return view("properties.index", [
            'properties' => $query->with("pictures")->recent()->paginate(25),
            'input' => $request->validated(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug, Property $property)
    {
        // Rediriger vers le bon url si slug pas bon
        if ($slug !== $property->getSlug()) {
            return to_route("properties.show", [
                "slug" => $property->getSlug(),
                "property" => $property->id
            ]);
        }

        return view("properties.show", [
            'property' => $property,
        ]);
    }

    public function contact(PropertyContactRequest $request, Property $property)
    {
        // 1) Envoi direct
        // Mail::send(new PropertyContactMail($property, $request->validated()));

        // 2) Envoi en utilisant les événements
        // event(new ContactRequestEvent($property, $request->validated()));

        // 3) Envoi en utilisant les notifications
        /** @var User $user */
        $user = User::first();
        $user->notify(new ContactRequestNotification($property, $request->validated()));

        return back()->with('success', "Votre demande de contact a bien été envoyé");
    }
}
