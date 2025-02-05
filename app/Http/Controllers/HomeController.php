<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $properties = Property::with("pictures")->recent()->limit(4)->get();

        return view("home", [
            'properties' => $properties,
        ]);
    }
}
